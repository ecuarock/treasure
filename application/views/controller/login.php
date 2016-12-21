<div class="span-24">
	<?php if( $error_validation == 1 ){?>
		<div class="prepend-8 span-8 append-8" style=" padding-top: 20px;">
			<div class="span-8 error" align="center">
				 <ul>
					<li>El usuario o la contrase&ntilde;a est&aacute;n incorrectos.</li>
				 </ul>
			</div>
		</div>
	<?php }?>
	<div class="prepend-8 span-8 append-8">
		<ul id="alerts" class="alerts">			
		</ul>
	</div>

	<form method="post" id="frmLogin" name="frmLogin">
		<br />
		<div class="prepend-9 span-6">
			<div class="span-6 line">
				<label class="span-6" for="txtUsername">Usuario:</label>
				<input type="text" class="span-6" name="txtUsername" id="txtUsername" title="Por favor ingrese su Nombre de Usuario" />
			</div>
			<div class="span-6 line">
				<label class="span-6" for="txtPassword">Contrase&ntilde;a:</label>
				<input type="password" class="span-6" name="txtPassword" id="txtPassword" title="Por favor ingrese su Contrase&ntilde;a" />
			</div>
			<div class="span-6 line">
				<input type="submit" id="btnSave" name="btnSave" value="Ingresar" />
			</div>
		</div>
	</form>
</div>