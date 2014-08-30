<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li class="<?php if ($ca === 'PanelController') echo 'active'; ?>"><a href="{{ URL::route('dashboard'); }}">Overview</a></li>
		<li class="<?php if ($ca === 'CalendarController') echo 'active'; ?>"><a href="{{ URL::route('dashboard'); }}">Calendar</a></li>
		<li class="<?php if ($ca === 'CustomersController') echo 'active'; ?>"><a href="{{ URL::route('customers'); }}">Customers</a></li>
		<li class="<?php if ($ca === 'StaffController') echo 'active'; ?>"><a href="{{ URL::route('staff'); }}">Staff</a></li>
		<li class="<?php if ($ca === 'ServicesController') echo 'active'; ?>"><a href="{{ URL::route('services'); }}">Services</a></li>
		<li class="<?php if ($ca === 'ServicesController') echo 'active'; ?>"><a href="{{ URL::route('services'); }}">Products</a></li>
		<li class="<?php if ($ca === 'ServicesController') echo 'active'; ?>"><a href="{{ URL::route('services'); }}">Sales</a></li>
		<li class="<?php if ($ca === 'BranchesController') echo 'active'; ?>"><a href="{{ URL::route('branches'); }}">Branches</a></li>
		<li class="<?php if ($ca === 'AppointmentsController') echo 'active'; ?>"><a href="{{ URL::route('appointments'); }}">Appointments</a></li>
		<li class="<?php if ($ca === 'SettingsController') echo 'active'; ?>"><a href="{{ URL::route('settings'); }}">Settings</a></li>
	</ul>
	<!--	<ul class="nav nav-sidebar">
			<li><a href="">Nav item</a></li>
		</ul>-->
</div>