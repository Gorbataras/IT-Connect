<?php
?>

<!--header for the page-->
<include href="views/parts/header.php"></include>
<!--  Latest compiled and minified CSS-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
<link rel="stylesheet" href="css/upcomingEvents.css">
<!--navbar-->
<include href="views/parts/navbar.php"></include>


<body>
<div class="site-container">
		<div class="row">
			<div class="col upcomingEventsBody">
				<h1>Upcoming Events</h1>
				<!--where upcoming Events table is generated-->
				<table id="eventsTable" class="table table-hover table-bordered" >
					<thead>
					<tr>
						<th scope="col">Event Title</th>
						<th scope="col">Date</th>
						<th scope="col">Time</th>
						<th scope="col">Host</th>
						<th scope="col">Venue</th>
					</tr>
					</thead>
					<tbody>

						<F3:repeat group="{{ @upcomingEvents }}" value="{{ @event }}">

							<tr>
								<th scope="row"><a target="_blank" class="no-decoration" href="{{@event.link}}">{{@event.name}}</a></th>
									<td>{{date_format(date_create(@event.local_date), "D M d, Y")}}</td>
									<td>{{date("g:i a", strtotime(@event.local_time))}}</td>
									<td>{{@event.group.name}}</td>
									<td>{{@event.venue.name}}</td>
							</tr>
						</F3:repeat>
					</tbody>
				</table>
			</div>
		</div>
</div>


	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>

</body>


<include href="views/parts/footer.php"></include>