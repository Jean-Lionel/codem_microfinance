@csrf
<div class="row">
{{-- 	<input type="text" name="number" id="test" pattern="([0-9]{1,3}).([0-9]{1,3})" title="Must contain a decimal number"> --}}
	
	<div class="col-md-10">
		<h5 class="text-center">Enregistre une nouvel opération</h5>
	</div>
	<div class="col-md-6">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $operation->compte_name ? $operation->compte_nam : 'COO-'}}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group hide">
			<label for="type_operation">TYPE D'OPERATION</label>
			<select class="form-control {{$errors->has('type_operation') ? 'is-invalid' : 'is-valid' }}" id="type_operation"  name="type_operation">
				<option value="{{ old('type_operation') ?? $operation->type_operation }}">

					{{ old('type_operation') ?? $operation->type_operation ?? 'choississez une opération' }}

				</option>

				@canany(['is-versement-user', 'is-admin'])
				    {{-- expr --}}
				    <option value="VERSEMENT">VERSEMENT</option>
				@endcanany

				@canany(['is-retrait-user', 'is-admin'], Model::class)
				    {{-- expr --}}
				    <option value="RETRAIT">RETRAIT</option>
				@endcanany
				
				
			</select>
			{!! $errors->first('type_operation', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
		
	</div>

	<div class="col-md-6 hide">

		<fieldset class="form-group">
			<label for="operer_par">OPERER PAR </label>
			<input type="text" class="form-control {{$errors->has('operer_par') ? 'is-invalid' : 'is-valid' }}" id="operer_par"   name="operer_par" value="{{ old('operer_par') ?? $operation->operer_par }}">
			{!! $errors->first('operer_par', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<fieldset class="form-group">
			<label for="cni">CNI </label>
			<input type="text" class="form-control {{$errors->has('cni') ? 'is-invalid' : 'is-valid' }}" id="cni"   name="cni" value="{{ old('cni') ?? $operation->cni }}">
			{!! $errors->first('cni', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		
	</div>

	<div class="row container hide  ">

		<fieldset class="form-group col-md-6">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }} number" id="montant"   name="montant" value="{{ old('montant') ?? $operation->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<div class="form-group offset-md-1  col-md-5">
			<label for=""></label>
			<button type="submit" class="btn mr-0 mt-2 btn-outline-primary btn-block"> {{ $btnTitle}}</button>
		</div>
		
	</div>
</div>

@section('javascript')

<script>

	var fnf = document.getElementById("montant");

	fnf.addEventListener('keyup', function(evt){
	    var n = parseInt(this.value.replace(/\D/g,''),10);
	    if(fnf.value != "")
	    	fnf.value =  new Intl.NumberFormat('de-DE').format(n) ;
	}, false);


	const formatNumber = (number) => {
			return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'FBU' }).format(number)
		}


	function isDoubleClicked(element) {
    //if already clicked return TRUE to indicate this click is not allowed
    if (element.data("isclicked")) return true;

    //mark as clicked for 1 second
    element.data("isclicked", true);
    setTimeout(function () {
        element.removeData("isclicked");
    }, 1000);

    //return FALSE to indicate this click was allowed
    return false;
}


	function resetInput(){
		$('#operer_par').val('')
		// $('#type_operation').val('RETRAIT')
		$('#cni').val('')
		$('#compte_name').attr('disabled',false)

		$('.hide').hide()
	}

	function showContent(compte ="",name="",cni=""){

		$('#operer_par').val(name)
		// $('#type_operation').val('RETRAIT')
		$('#cni').val(cni)
		$('#compte_name').attr('disabled',true)

		$('.hide').show()
		

	}



	jQuery(document).ready(function() {
		let hide = $('.hide').hide()

		let compte_name = $('#compte_name')

		//console.log(compte_name.val('bonjour'))

		compte_name.on('keyup',  function(event) {
			event.preventDefault();

			/* Act on the event */

			if (event.key === 'Enter' || event.keyCode === 13) {
        // Do somethin
        				$("#loader").show()

					$.ajax({
						url: '{{ route('client_by_compte_name') }}',
						type: 'GET',
						dataType: 'json',
						data: {compte_name: compte_name.val()},
					})
					.done(function(data) {
						
						//console.log("Decouverts : ",data.decouverts);
						if(!data.error){
							$('.client-info').html(client_information(data))

						}else{
							$('.client-info').html(`
								<h5 class= "bg-danger">Numéro matricule est invalidé</h5>
								`)
						}
						// client_information(data.client);
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});

			 }
		});


		let client_information = (data) => {

			var tr_decouverts = `<tbody`;

			if(data.decouverts.length > 0){

				data?.decouverts?.map((e , index)=> {
					var tr = `
					<tr>
						<td>${++index}</td>
						<td>${e.id}</td>
						<td>${e.montant_restant}</td>
						<td>${e.date_fin}</td>
					</tr>
					`
					tr_decouverts += tr;
				})


			}

			tr_decouverts += `</tbody>`;

			console.log(data);
			let html = `
			<div class="information">

			<div class="bg-dark text-center">
			<p class="card-text text-white display-5 col-md-12">
			SOLDE : #${formatNumber(data.compte.montant)} </p>
			</div>

			<div class="card-group">

			<div class="card ml-2">
			<b class="card-title">Nom : ${data.client.nom}</b>
			<b class="card-title">prénom : ${data.client.prenom}</b>
			<b class="card-title">NUMERO DE COMPTE : ${data.client.id}</b>
			<b class="card-title">C.N.I : ${data.client.cni}</b>
			<b class="card-title">Date de Naissance :${data.client.date_naissance} </b>

			<h5 class="text-center"><u><b>Les mandataires </b></u></h5>

				<ul class="list-group">
					<li class="list-group-item">
					<ul class="list-inline">
						<li class="list-inline-item"><b>1. </b> ${data.client.signateur_1_nom_prenom}</li>
						<li class="list-inline-item"> C.N.I: ${data.client.signateur_1_cni}</li>
						<li class="list-inline-item">TEL : ${data.client.signateur_1_tel}</li>
					</ul>

					</li>
					<li class="list-group-item">
						<ul class="list-inline">
							<li class="list-inline-item"><b>2. </b> ${data.client.signateur_2_nom_prenom} </li>
							<li class="list-inline-item">C.N.I: ${data.client.signateur_2_cni}</li>
							<li class="list-inline-item">TEL: ${data.client.signateur_2_tel}</li>
						</ul>
					</li>
					<li class="list-group-item">
						<ul class="list-inline">
							<li class="list-inline-item"><b>3. </b> ${data.client.signateur_3_nom_prenom} </li>
							<li class="list-inline-item">C.N.I: ${data.client.signateur_3_cni}</li>
							<li class="list-inline-item">TEL: ${data.client.signateur_3_tel}</li>
						</ul>

					</li>
				</ul>
			</div>

			<div class="card">
			<img class="card-img-top" 
			src="/img/client_images/${data.client.image}"  
			alt="image" style="width: auto">
			</div>
			</div>
			
			</div>

			<div class="mt-3">	
			
			<button class="btn btn-success user_compte" onClick="showContent(
			'${data.compte.name}',
			'${data.client.nom} ${data.client.prenom}','${data.client.cni}')" >Nyene ikonti</button>

			<button class="btn btn-warning" onClick="showContent('${data.compte.name}')" > Uwatumwe</button>

			<button class="btn btn-danger" onClick="resetInput()" > Réinitialiser</button>
			</div>

			<div class="row">
			<div class="card bg-primary">
			
			</div>
			</div>
			</div>

			<div>
			Decouvert a remboursé
			<table class="table table-sm">
				<thead class="table-sm bg-secondary">
					<tr>
						<th>#</th>
						<th>Decouvert No</th>
						<th>Montant restant</th>
						<th>Délai Limite</th>
					</tr>
				</thead>
				${tr_decouverts}
			</tabl>
			</div>

			`

			return html;
		}
		let save = $('button[type="submit"]')

		save.on('click' , function(event){
			event.preventDefault()
			if (isDoubleClicked($(this))) {
				return;
			}
			console.log(event);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name="_token"]').val()
				}
			});

			let compte_name = $('#compte_name').val()
			let montant = $('#montant').val().replace(/\D/g,'')
			let operer_par = $('#operer_par').val()
			let type_operation = $('#type_operation').val()
			let cni = $('#cni').val()

			if(montant <= 0 || isNaN(montant)){

				swal.fire(
					'error',
					'Vérifier le montant saisit',
					'error'
					)

				return;

			}

			if(compte_name.trim() == "" ||
			 montant.trim() == "" ||
			 operer_par.trim() == "" ||
			 type_operation.trim() == "" ||
			 cni.trim() == "" 

				){
				swal.fire(
					'error',
					'Champs vide',
					'error'
					)

				return ;

			}


			$.ajax({
				url: '{{ route('operations.store')}}',
				type: 'POST',

				data: {
					compte_name,
					montant ,
					operer_par,
					type_operation,
					cni,
					
				},
			})
			.done(function(response) {

				let title = Object.keys(response)[0];
				
				let body = response.error ? response.error : response.success
				
				swal.fire(
					title,
					body,
					title
					)

				if(title == 'success'){

					$('#form_id').trigger("reset");
					
				}

				if(response.success){
					window.location.replace("{{ route('operations.index') }}");

				}

				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		})

		
	});

	
</script>

@endsection















