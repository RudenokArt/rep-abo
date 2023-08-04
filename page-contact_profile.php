<?php include_once 'kundenportal/init.php'; ?>

<div class="h2">Profile</div>
<form action="" method="post">
	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			NAME
		</span>
		<input type="text" class="form-control" name="NAME" value="<?php echo $B24_CONTACT->data['NAME'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			TELEFON
		</span>
		<input type="hidden" class="form-control" name="PHONE[0][ID]" value="<?php echo $B24_CONTACT->data['PHONE'][0]['ID'] ?>">
		<input type="text" class="form-control" name="PHONE[0][VALUE]" value="<?php echo $B24_CONTACT->data['PHONE'][0]['VALUE'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			EMAIL
		</span>
		<input type="hidden" class="form-control" name="EMAIL[0][ID]" value="<?php echo $B24_CONTACT->data['EMAIL'][0]['ID'] ?>">
		<input type="text" class="form-control" name="EMAIL[0][VALUE]" value="<?php echo $B24_CONTACT->data['EMAIL'][0]['VALUE'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			ZWEITNAME
		</span>
		<input type="text" class="form-control" name="SECOND_NAME" value="<?php echo $B24_CONTACT->data['SECOND_NAME'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			NACHNAME
		</span>
		<input type="text" class="form-control" name="LAST_NAME" value="<?php echo $B24_CONTACT->data['LAST_NAME'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			LOGIN
		</span>
		<input type="text" class="form-control" name="UF_USER_LOGIN" value="<?php echo $B24_CONTACT->data['UF_USER_LOGIN'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			PASSWORT
		</span>
		<input type="password" class="form-control" name="UF_USER_PASSWORD" value="<?php echo $B24_CONTACT->data['UF_USER_PASSWORD'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			ADRESSE
		</span>
		<input type="text" class="form-control" name="ADDRESS" value="<?php echo $B24_CONTACT->data['ADDRESS'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			STADT
		</span>
		<input type="text" class="form-control" name="ADDRESS_CITY" value="<?php echo $B24_CONTACT->data['ADDRESS_CITY'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			POSTLEITZAHL
		</span>
		<input type="text" class="form-control" name="ADDRESS_POSTAL_CODE" value="<?php echo $B24_CONTACT->data['ADDRESS_POSTAL_CODE'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			REGION
		</span>
		<input type="text" class="form-control" name="ADDRESS_REGION" value="<?php echo $B24_CONTACT->data['ADDRESS_REGION'] ?>">
	</div>

	<div class="input-group mb-3">
		<span class="input-group-text w-50">
			LAND
		</span>
		<input type="text" class="form-control" name="ADDRESS_COUNTRY" value="<?php echo $B24_CONTACT->data['ADDRESS_COUNTRY'] ?>">
	</div>
	<div class="pb-5">
		<button name="contact_update" value="Y" class="btn btn-lg btn-primary w-100">
			<i class="fa fa-floppy-o" aria-hidden="true"></i>
			speichern
		</button>
	</div>
</form>

<?php include_once 'kundenportal/layout/footer.php'; ?>