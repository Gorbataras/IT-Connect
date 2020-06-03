<div class="tab-pane fade" id="nav-meetups" role="tabpanel" aria-labelledby="nav-meetups-tab">
    <h2 class="my-3">Meetups</h2>
	<form action="/adminPage?source-tab=meetups&task=add" method="post" class="form-group">

		<F3:check if="{{ isset(@meetupSourceError) }}">
			<span class="password-error">{{ @meetupSourceError }}</span>
		</F3:check>
		<br><br>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" id="meetup-pre">https://meetup.com/</span>
			</div>

			<input class="form-control" type="text" name="new-group" id="new-group"
				   placeholder="Sample-Group-Name" required>

			<button type="submit" class="btn btn-success ml-3">Add</button>
		</div>
	</form>


<!--	DISPLAY ALL CURRENT MEETUP GROUP SOURCES -->
	<ul class="list-group">
		<F3:repeat group="{{ @meetupGroupsList }}" value="{{ @value }}">
			<form class="form-group" action="/adminPage?source-tab=meetups&task=delete" method="post">
				<li class="list-group-item">
					<div class="row">
						<div class="col">
							<p class="h5">{{ @value.source_name }}</p>
						</div>
						<div class="col text-right">
							<button class="btn" type="submit">&#128465</button>
							<input name="entry" type="text" value="{{ @value.source_name }}" hidden>
						</div>
					</div>
				</li>
			</form>
		</F3:repeat>
	</ul>
</div>
