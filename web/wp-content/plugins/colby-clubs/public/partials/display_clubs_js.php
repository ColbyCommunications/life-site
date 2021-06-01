
<div class="clubs-orgs">
	
	<div class="clubs-orgs__filter">
		<div class="clubs-orgs__filter__search">
			<label for="club_search" class="screen-reader-text">SEARCH:</label>
			<input type="text" name="club_search" id="club_search" placeholder="Search by keyword" aria-label="Keyword Search for Clubs and Organizations">
		</div>
		<div class="clubs-orgs__filter__cats">
			<?php echo Colby_Clubs_Public::display_category_list(); ?>
		</div>
	</div>

	<div class="clubs-orgs__results">
		<div class="loading" id="club_loading">Fetching Clubs & Organizations...</div>
		<div class="loading" id="club_noresults">There are no clubs or organizations matching your search criteria</div>
		<div class="results" id="club_results"></div>
		<div class="pagination" id="club_pagination"></div>
	</div>

</div>
