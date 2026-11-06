          
        </section>
        <footer>
        <b>Instituto de Neurodesarrollo, UNAM, 2015   </b>
        </footer>		
	</div>	 
        <div id="mensajeCargando" class="mensaje mensajeCargando"></div>
        <div id="mensajeInfo" class="mensaje mensajeInfo"></div>
        <div id="mensajeError" class="mensaje mensajeError"></div>
        <div id="mensajeOK" class="mensaje mensajeOK"></div>
        <div id="mensajePreventivo" class="mensaje mensajePreventivo"></div>


        <div id="alertcontainer">

          <div id="alertbg"></div>

          <div id="messagefg">

            <div align="center">

              <div></div>

            </div>

          </div>

        </div>
		

		<!-- The Modal -->
		<div id="myModal" class="modal">

		  <!-- Modal content -->
		  <div class="modal-content">
			<div class="modal-header">
			  <span class="close">&times;</span>
			  <h2 id="modal-header">Detalle de Faltas</h2>
			</div>
			<div class="modal-body">
			  <p>Some text in the Modal Body</p>
			  <p>Some other text...</p>
			</div>
			
		  </div>

		</div>
		<script>

		var modal = document.getElementById('myModal');			

		var span = document.getElementsByClassName("close")[0];
		

		span.onclick = function() {		
			modal.style.display = "none";
			$("#modal-header").html("");
		}

		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
				$("#modal-header").html("");
			}
		}
	</script>

</body>
</html>