<?php
die("Direct invocation isn't allowed.");
?>

<main role="main" class="container-flex">
	<div class= "container">
        <div class= "row">
            <div class= "numcol">
                <pre class="prenum">
                    <code width="10">
{displaynums}
                    </code>
                </pre>
            </div>
            <div class= "col codecol">
                <pre class="precode">
                	<code>
{displaycode}
                	</code>
             	</pre>
            </div>
            <div class= "col">
                <form action="dashboard.html">
                  <div>
                    <h4> Sicherheit </h4>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="security" value="1"> 1
                        </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="security" value="2"> 2
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="security" value="3"> 3
                        </label>
                    </div>

                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="security" value="4"> 4
                        </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="security" value="5"> 5
                        </label>
                    </div>
                    
                    <p>
                        <textarea id="securitycomment" class= "span6" rows= "5" placeholder= "Anmerkungen"></textarea>
                    </p>
                  </div>
                  
                  <div>
                    <h4> Sauberkeit </h4>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="cleanliness" value="1"> 1
                        </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="cleanliness" value="2"> 2
                        </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="cleanliness" value="3"> 3
                        </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="cleanliness" value="4"> 4
                        </label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="cleanliness" value="5"> 5
                        </label>
                    </div>
                    
                    <p>
                        <textarea id="cleanlinesscomment" class= "span6" rows= "5" placeholder= "Anmerkungen"></textarea>
                    </p>
                  </div>
                  
                    <p>
                        <textarea id="misccomment" class= "span6" rows= "5" placeholder= "Sonstiges"></textarea>
                    </p> 
                  <button type= "submit" class= "btn btn-primary">Absenden</button>
                   
                </form>
            </div>
        </div>
    </div>
</main>