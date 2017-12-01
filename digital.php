<center>
<form id="dealerid" action=''>
	<label>Enter Dealer Code </label><br>
    <input type='text' name='code' id='code' placeholder='Enter a Dealer code..' />
    <input type="submit" class='small-button' id='dealerCode' value="Go">
</form>
</center>
<script type="text/javascript">
var theForm = document.getElementById('dealerid');
var theInput = document.getElementById('code');

theForm.onsubmit = function(e){
    location = "proofing.accunityservices.com/digitalsignature/public/en/placeorder/" 
                              + encodeURIComponent(theInput.value);
    return false;
}
</script>
