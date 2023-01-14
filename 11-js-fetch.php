<script>
fetch("https://ipinfo.io/json")
  .then(response => {    
if (response.ok)
      return response.text()
    else
      throw new Error(response.status);
 })
  .then(data => {
 	  // sentencias a ejecutar
	   console.log("Datos: " + data);

       
  })
  .catch(err => {
   	 console.error("ERROR: ", err.message)
  });
  </script>
