@extends('redminportal::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            {{ HTML::image( URL::to('packages/redooor/redminportal/assets/img/redminportal_logo.png'), 'RedminPortal', array('class' => 'img-responsive') )}}
        </div>
    </div>
    <div class='row'>
        <div class='col-md-8'>
            <h1>RedminPortal <small>by Redooor</small></h1>
            <h2><u>Change log</u></h2>
            <h3>Version 0.1.2</h3>
            <h4>Enhancements:</h4>
            <ol>
                <li>Temporarily increase memory to 256MB for testing.</li>
                <li>Users View page: show Groups instead of Permission.</li>
                <li>Added section head in master layout blade. Can be used by Views to add in styles or scripts in the header without changing the Layout.</li>
                <li>Consolidated Tinymce into a separate view under Plugins folder (issue #1).</li>
                <li>Minor UI change: autofocus email input on login page.</li>
                <li>Category select list changed to hierarchical list (issue #11).</li>
            </ol>
            <h4>Bug fixes:</h4>
            <ol>
                <li>Resolved missing translation text on user login and creation page.</li>
                <li>Hide menu from unauthorised user.</li>
                <li>Resolved issue #3 where login catch exception not working.</li>
                <li>Resolved issue #10 where media controller change category unable to move existing files.</li>
            </ol>
            <h4>Pull requests:</h4>
            <ol>
                <li>Fixed migration foreign reference by @tusharvikky</li>
            </ol>
            <h3>Version 0.1.1</h3>
            <ol>
                <li>Supports Laravel 4.2.</li>
                <li>Moved Twitter Bootstrap to require-dev.</li>
                <li>Dynamically creates in-memory sqlite database for test.</li>
                <li>Fixed an issue when accessing admin/login directly.</li>
                <li>Added translation zh-tw and zh-cn to login page and main menus.</li>
                <li>Resolved issue where package Config cannot be overriden.</li>
                <li>Temporarily increase memory to 256MB for testing.</li>
            </ol>
            <h3>Version 0.1.0</h3>
            <ol>
                <li>Supports Laravel 4.1.</li>
                <li>Added PHPUnit testing and fixed Model test errors.</li>
                <li>Menu view can be controlled via config/menu.php file.</li>
                <li>UI improvement.</li>
                <li>Added Purchase history page.</li>
                <li>Media supports huge file upload (via a plugin).</li>
                <li>Able to activate user from admin portal.</li>
                <li>Added ability to insert picture in Announcement page.</li>
                <li>Added downloadable CSV reports for Purchases and Mailinglist.</li>
                <li>Many bug fixes.</li>
            </ol>
            <h4>Added the following new Models</h4>
            <ol>
                <li>Price list for Media and Membership</li>
                <li>Discount table</li>
                <li>Media</li>
                <li>Membership</li>
                <li>Module</li>
                <li>Mailinglist</li>
            </ol>
        </div>
        <div class='col-md-4'>
            <h3>Contribution</h3>
            <p>Source code at <a href="https://github.com/redooor/redminportal">Github</a></p>
            <h3>Maintenance</h3>
            <p>Maintained by the core team with the help of our contributors.</p>
            <h3>License</h3>
            <p>RedminPortal is open-sourced software licensed under the <a href="http://opensource.org/licenses/MIT">MIT license</a>.</p>
        </div>
    </div>
@stop
