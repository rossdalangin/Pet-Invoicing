<form id="quote-request-form" action="" method="post">
	<fieldset>
		<legend>Your Information</legend>
		<p>
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" id="first_name" required>
		</p>
		<p>
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" id="last_name" required>
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" name="email" id="email" required>
		</p>
		<p>
			<label for="phone">Phone</label>
			<input type="tel" name="phone" id="phone" required>
		</p>
		<p>
			<label for="address">Address</label>
			<input type="text" name="address" id="address" required>
		</p>
		<p>
			<label for="city">City</label>
			<input type="text" name="city" id="city" required>
		</p>
		<p>
			<label for="state">State</label>
			<input type="text" name="state" id="state" required>
		</p>
		<p>
			<label for="zip">Zip</label>
			<input type="text" name="zip" id="zip" required>
		</p>
	</fieldset>
	<fieldset>
		<legend>Pet Information</legend>
		<p>
			<label for="pet_name">Pet Name</label>
			<input type="text" name="pet_name" id="pet_name" required>
		</p>
		<p>
			<label for="pet_type">Pet Type</label>
			<input type="text" name="pet_type" id="pet_type" required>
		</p>
		<p>
			<label for="pet_breed">Pet Breed</label>
			<input type="text" name="pet_breed" id="pet_breed" required>
		</p>
		<p>
			<label for="pet_age">Pet Age</label>
			<input type="number" name="pet_age" id="pet_age" required>
		</p>
		<p>
			<label for="pet_weight">Pet Weight (lbs)</label>
			<input type="number" name="pet_weight" id="pet_weight" step="0.01" required>
		</p>
	</fieldset>
	<fieldset>
		<legend>Flight Information</legend>
		<p>
			<label for="origin_airport">Origin Airport</label>
			<input type="text" name="origin_airport" id="origin_airport" required>
		</p>
		<p>
			<label for="destination_airport">Destination Airport</label>
			<input type="text" name="destination_airport" id="destination_airport" required>
		</p>
		<p>
			<label for="flight_date">Flight Date</label>
			<input type="date" name="flight_date" id="flight_date" required>
		</p>
	</fieldset>
	<p>
		<input type="submit" name="submit_quote_request" value="Request Quote">
	</p>
</form>
