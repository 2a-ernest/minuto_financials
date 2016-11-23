// var minuto = angular.module('minuto',['datatables','datatables.bootstrap','ngCookies']);
var minuto = angular.module('minuto',['ngResource','ui.router']);

//api resourse declarations for fetching json information
minuto.factory('API_RESOURCE',['$resource',function($resource){

    return {
      client:$resource('/client/:id',{id:'@id'},{
          update: {
          method: 'PUT' // this method issues a PUT request
        }}),
      account:$resource('/account/:id',{id:'@id'},{
          update: {
          method: 'PUT' // this method issues a PUT request
        }}),
      transaction:$resource('/transaction/:id',{id:'@id'},{
          update: {
          method: 'PUT' // this method issues a PUT request
        }}),
      production:$resource('/production/:id',{id:'@id'},{
        updade:{
          method: 'PUT' //this method issues a PUT request
        }
      }),
      sheet:$resource('/sheet/:id',{id:'@id'},{
        updade:{
          method: 'PUT' //this method issues a PUT request
        }
      }),
      stock:$resource('/stock/stock')
    }
  }]);


//view routes for angular
 minuto.config(['$stateProvider','$urlRouterProvider','$locationProvider',function($stateProvider, $urlRouterProvider,$locationProvider) {
    //
    // For any unmatched url, redirect to /state1
    // $urlRouterProvider.otherwise("/dashboard");
    //
    // Now set up the states
    $stateProvider
      .state('clients',{
        url: '/clients',
        templateUrl:'/partials/admin/clients.html',
        controller:'adminCtrl'
      })
      .state('client_accounts',{
        url:'/client/{id}/accounts',
        templateUrl:'/partials/admin/client_accounts.html',
        controller: 'adminClientAccCtrl'
      })
      .state('account_transactions',{
        url:'/account/{id}/transactions',
        templateUrl:'/partials/admin/account_transacions.html',
        controller: 'adminAccTransactionCtrl'
      });
      // $locationProvider.html5Mode({enabled:true,requireBase:false});
  }]);

//all controllers go here during dev and will be separeted to indiviual file for admin, client and employee protals
minuto.controller('adminCtrl',function($scope,API_RESOURCE,$filter){
  //Controller for view.admin.index.blade.php


  //fetch list of clients from the server and place them inside $scope.clients
  function initClients(){
    API_RESOURCE.client.query(function(response){
      //closure function is passed to query method contanaining a parameter knwon as response which is populated with value of json response
      $scope.clients = $filter('orderBy')(response,['-created_at','-id']);
      //json respons is assigned to clients
    });
  }

  // function for adding new clients
  $scope.create = function(newClient){
    API_RESOURCE.client.save(newClient,function(data){
      console.log(data,'saved');
      /*show success dialog*/
      swal('Client Added','Client password is "'+data.password+'"','success');
      //clear newClient information by setting it blank new object
      $scope.newClient = newClient ={};

      //reload all clients again
      initClients();

    },function(err){
      swal({
            title: "Invalid fields",
            text: "Please fill all fields marked with asterisks (*)",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Continue",
            closeOnConfirm: true
        }, function(){
            //show addClientModal again
            $scope.showClientAddModal();
        });
    });
  };

  //function to show modal for new client
  $scope.showClientAddModal = function(){
    $('#addClientModal').modal();
    // console.log('hello');
  };

  $scope.delete = function(dClient,delete_option){
    //delete_codes 1=softdelete,2=restore,4=forceDelete
    //show sweet-alert dialog asking for delete confirmation,
    swal({
                  title: "Are you sure?",
                  text: "This action will remove client '" + dClient.lname +' '+ dClient.fname+"'",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel deletion!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              }, function(isConfirm){
                   // if the user cliens the confirm button then,
                  if (isConfirm) {
                        var delete_option_code = null;
                        //add delete_option_code as field to dClient based on delete_option supplied
                        switch(delete_option){
                          case 'delete': delete_option_code = 1;break;
                          case 'restore': delete_option_code = 2;break;
                          case 'forceDelete': delete_option_code = 3;break;
                        }

                        dClient.delete_option_code = delete_option_code;
                       // perform actual deletion
                     API_RESOURCE.client.delete(dClient,function(data){
                      console.log(data,'deleted');
                      swal('Deleted','','success');
                      initClients();
                     });
                  } else {
                      swal("Cancelled", "Client is untouched", "error");
                  }
              });

  };

  $scope.update= function(newClient){

          API_RESOURCE.client.update(newClient,function(data){
                  swal('Updated','','success');
                  initClients();
          },function(error){
            swal({
                  title: "Invalid fields",
                  text: "Please fill all fields marked with asterisks (*)",
                  type: "warning",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Continue",
                  closeOnConfirm: true
              }, function(){
                  $scope.updateClientModal(newClient);
              });

          })
        },

    $scope.updateClientModal = function(newClient){
          $scope.tempClient = newClient;
          $scope.newClient = JSON.parse(JSON.stringify(newClient));
          $scope.tempClient.created_at = new Date(newClient.created_at);

          $('#updateClientModal').modal();
          // surfaceDatePicker('#updateModalTransportInvoice');
        },




  initClients();

});

//controller for adminClientAccCtrl template
minuto.controller('adminClientAccCtrl',function($scope,API_RESOURCE,$filter,$stateParams){

  function initClientAcc(){
    //fetch client info with all associated accounts by using client id supplied in angular $stateParam
    API_RESOURCE.client.get({id:$stateParams.id},function(response){
      $scope.client = response;

      //now load all accounts for the client
      $.each($scope.client.accounts,function(key,val){


        // console.log('account_info',val);
        API_RESOURCE.account.get({id:val.id},function(response){
          $scope.client.accounts[key] = response;
        });
      });
      console.log('fetched values from laravel',$scope.client);
    });
  }

  $scope.delete = function(p_acc,delete_option){
    console.log(p_acc);
    swal({
                  title: "Are you sure?",
                  text: "This action will remove account '" + p_acc.id +' '+ p_acc.type.type+"'",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel deletion!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              }, function(isConfirm){
                   // if the user cliens the confirm button then,
                  if (isConfirm) {
                        var delete_option_code = null;
                        //add delete_option_code as field to dClient based on delete_option supplied
                        switch(delete_option){
                          case 'delete': delete_option_code = 1;break;
                          case 'restore': delete_option_code = 2;break;
                          case 'forceDelete': delete_option_code = 3;break;
                        }

                        p_acc.delete_option_code = delete_option_code;
                       // perform actual deletion
                     API_RESOURCE.account.delete(p_acc,function(data){
                      console.log(data,'deleted');
                      swal('Deleted','','success');
                      initClientAcc();
                     });
                  } else {
                      swal("Cancelled", "Account is untouched", "error");
                  }
              });

  }

  initClientAcc();
});


minuto.controller('adminAccTransactionCtrl',function($scope,API_RESOURCE,$filter,$stateParams){

  function initAccTransactions(){
    //fetch client info with all associated accounts by using client id supplied in angular $stateParam
    API_RESOURCE.account.get({id:$stateParams.id},function(response){
      $scope.account = response;

      $scope.account.transactions = $.merge($($scope.account.debit_transactions),$scope.account.credit_transactions);


      //print size of 3 transactions
      console.log('deb',$scope.account.debit_transactions.length,'cred',$scope.account.credit_transactions.length,'alltrans',$scope.account.transactions.length);

      //now load all accounts for the client
      // $.each($scope.client.accounts,function(key,val){
      //

        // console.log('account_info',val);
      //   API_RESOURCE.account.get({id:val.id},function(response){
      //     $scope.client.accounts[key] = response;
      //   });
      // });
      // console.log('fetched values from laravel',$scope.client);
    });
  }

  $scope.delete = function(p_acc,delete_option){
    console.log(p_acc);
    swal({
                  title: "Are you sure?",
                  text: "This action will remove account '" + p_acc.id +' '+ p_acc.type.type+"'",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel deletion!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              }, function(isConfirm){
                   // if the user cliens the confirm button then,
                  if (isConfirm) {
                        var delete_option_code = null;
                        //add delete_option_code as field to dClient based on delete_option supplied
                        switch(delete_option){
                          case 'delete': delete_option_code = 1;break;
                          case 'restore': delete_option_code = 2;break;
                          case 'forceDelete': delete_option_code = 3;break;
                        }

                        p_acc.delete_option_code = delete_option_code;
                       // perform actual deletion
                     API_RESOURCE.account.delete(p_acc,function(data){
                      console.log(data,'deleted');
                      swal('Deleted','','success');
                      initClientAcc();
                     });
                  } else {
                      swal("Cancelled", "Account is untouched", "error");
                  }
              });

  }

  initAccTransactions();
});
