<style>.navigation{font-family: Arial, Helvetica, sans-serif;}</style>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <?php if  (isset($page )==FALSE)  $page="Home"; ?>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="<?php if($page=='Home') {echo'active';}?>"><a href="{{ route('dashboard') }}"><i class="icon-home"></i><span class="menu-title" data-i18n="nav.email-application.main">Dashboard</span></a>
          </li>
          <li class="<?php if($page=='Activity') {echo'active';}?>"><a href="{{ route('activity.index') }}"><i class="icon-user-female"></i><span class="menu-title" data-i18n="nav.email-application.main">Activity</span></a>
          </li>
          <li class="<?php if($page=='Objective') {echo'active';}?>"><a href="{{ route('objective.index') }}"><i class="icon-user-female"></i><span class="menu-title" data-i18n="nav.email-application.main">Objective</span></a>
          </li>
          <li class="<?php if($page=='Process') {echo'active';}?>"><a href="{{ route('process.index') }}"><i class="icon-user-female"></i><span class="menu-title" data-i18n="nav.email-application.main">Process</span></a>
          </li>
          <li class="<?php if($page=='User') {echo'active';}?>"><a href="{{ route('user.index') }}"><i class="icon-user-female"></i><span class="menu-title" data-i18n="nav.email-application.main">User</span></a>
          </li>
        </ul>
      </div>
    </div>
