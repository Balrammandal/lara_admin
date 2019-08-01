<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{{url('/')}}/admintheme/assets/img/user-13.jpg" alt="" /></a>
                </div>
                <div class="info">
                    {{ ucfirst(Auth::user()->f_name.' '.Auth::user()->l_name )}}
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <?php
        $segment= Request::segment(3);
        ?>
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="<?php if($segment=='dashboard' ){ echo 'active';}?>"><a href="{{route('admin::dashboard')}}"><i class="fa fa-calendar"></i> <span>Dashboard</span></a></li>
            <li class="has-sub <?php if($segment=='manage-user'){ echo 'active expand';}?>">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-laptop"></i>
                    <span>Dashboard</span>
                </a>
                <ul class="sub-menu" style="display: <?php if( $segment=='manage-user'){ echo 'block';}else{ echo 'none';} ?>">
                    <li class="<?php if( $segment=='manage-user'){ echo 'active';}?>"><a href="{{route('admin::manageUser')}}">Users</a></li>
                </ul>
            </li>


            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>