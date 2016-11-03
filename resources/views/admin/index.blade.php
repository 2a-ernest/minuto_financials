@extends('layouts.admin')

@section('content')


<div class="header">
    <div class="logo">
        <a href="dashboard.html"><img src="images/logo.png" alt="" /></a>
    </div>
    <div class="headerinner">
        <ul class="headmenu">
            <li class="odd">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="count">4</span>
                    <span class="head-icon head-message"></span>
                    <span class="headmenu-label">Messages</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-header">Messages</li>
                    <li><a href=""><span class="icon-envelope"></span> New message from <strong>Lee</strong> <small class="muted"> - 1 week ago</small></a></li>
                    <li class="viewmore"><a href="messages.html">View More Messages</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                <span class="count">10</span>
                <span class="head-icon head-users"></span>
                <span class="headmenu-label">New Users</span>
                </a>
                <ul class="dropdown-menu newusers">
                    <li class="nav-header">New Users</li>
                    <li>
                        <a href="">
                            <img src="images/photos/thumb1.png" alt="" class="userthumb" />
                            <strong>Draniem Daamul</strong>
                            <small>April 20, 2013</small>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="images/photos/thumb2.png" alt="" class="userthumb" />
                            <strong>Shamcey Sindilmaca</strong>
                            <small>April 19, 2013</small>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="images/photos/thumb3.png" alt="" class="userthumb" />
                            <strong>Nusja Paul Nawancali</strong>
                            <small>April 19, 2013</small>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="images/photos/thumb4.png" alt="" class="userthumb" />
                            <strong>Rose Cerona</strong>
                            <small>April 18, 2013</small>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="images/photos/thumb5.png" alt="" class="userthumb" />
                            <strong>John Doe</strong>
                            <small>April 16, 2013</small>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="odd">
                <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                <span class="count">1</span>
                <span class="head-icon head-bar"></span>
                <span class="headmenu-label">Statistics</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-header">Statistics</li>
                    <li><a href=""><span class="icon-align-left"></span> Most Viewed in <strong>Blog</strong> <small class="muted"> - 1 week ago</small></a></li>
                    <li class="viewmore"><a href="charts.html">View More Statistics</a></li>
                </ul>
            </li>
            <li class="right">
                <div class="userloggedinfo">
                    <img src="images/photos/thumb1.png" alt="" />
                    <div class="userinfo">
                        <h5>{{Auth::user()->lname .' '. Auth::user()->fname . ' '. Auth::user()->oname}} <small>- {{Auth::user()->email}}</small></h5>
                        <ul>
                            <li><a href="editprofile.html">Edit Profile</a></li>
                            <li><a href="">Account Settings</a></li>
                            <li>
                              <a href="{{ url('/logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul><!--headmenu-->
    </div>
</div>

    <div class="leftpanel">

        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Navigation</li>
                <li><a ui-sref='clients'><span class="iconfa-laptop"></span> Clients</a></li>
                <li><a href="#accounts"><span class="iconfa-hand-up"></span> Accounts</a></li>
                <li class="dropdown"><a href=""><span class="iconfa-pencil"></span> Forms</a>
                	<ul>
                    	<li><a href="forms.html">Form Styles</a></li>
                        <li><a href="wizards.html">Wizard Form</a></li>
                        <li><a href="wysiwyg.html">WYSIWYG</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href=""><span class="iconfa-briefcase"></span> UI Elements &amp; Widgets</a>
                	<ul>
                    	<li><a href="elements.html">Theme Components</a></li>
                        <li><a href="bootstrap.html">Bootstrap Components</a></li>
                        <li><a href="boxes.html">Headers &amp; Boxes</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href=""><span class="iconfa-th-list"></span> Tables</a>
                	<ul>
                    	<li><a href="table-static.html">Static Table</a></li>
                        <li><a href="table-dynamic.html">Dynamic Table</a></li>
                    </ul>
                </li>

                <li><a href="media.html"><span class="iconfa-picture"></span> Media Manager</a></li>
                <li><a href="typography.html"><span class="iconfa-font"></span> Typography</a></li>
                <li><a href="charts.html"><span class="iconfa-signal"></span> Graph &amp; Charts</a></li>
                <li><a href="messages.html"><span class="iconfa-envelope"></span> Messages</a></li>
                <li><a href="calendar.html"><span class="iconfa-calendar"></span> Calendar</a></li>
                <li class="dropdown active"><a href=""><span class="iconfa-book"></span> Other Pages</a>
                	<ul style="display:block">
                        <li><a href="404.html">404 Error Page</a></li>
                        <li class="active"><a href="editprofile.html">Edit Profile</a></li>
                        <li><a href="invoice.html">Invoice Page</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--leftmenu-->

    </div><!-- leftpanel -->

    <div class="rightpanel">

        <ul class="breadcrumbs">
            <li><a href="dashboard.html"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li><a href="editprofile.html">Other Pages</a> <span class="separator"></span></li>
            <li>Edit Profile</li>

            <li class="right">
                <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tint"></i> Color Skins</a>
                <ul class="dropdown-menu pull-right skin-color">
                    <li><a href="default">Default</a></li>
                    <li><a href="navyblue">Navy Blue</a></li>
                    <li><a href="palegreen">Pale Green</a></li>
                    <li><a href="red">Red</a></li>
                    <li><a href="green">Green</a></li>
                    <li><a href="brown">Brown</a></li>
                </ul>
            </li>
        </ul>

        <div class="pageheader">
            <form action="results.html" method="post" class="searchbar" />
                <input type="text" name="keyword" placeholder="To search type and hit enter..." />
            </form>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>Clients</h5>
                <h1>Manage clients</h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
                <div class="container">
                    <!-- code for view of angular ui-routes are inserter here -->
                    <div ui-view></div>   
                 
                </div><!--row-fluid-->

                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2013. Shamcey Admin Template. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://themepixels.com/">ThemePixels</a></span>
                    </div>
                </div><!--footer-->

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

@endsection
