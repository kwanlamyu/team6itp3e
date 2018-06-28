
<?php include 'header.php';?>

<?php include 'navigation_superadmin.php';?>


    <body>
        
        <form id="masterTemplate" name="master" action="preview.php" method="POST" style="padding: 50px;">
		
		<h1>Master Template</h1>

            <div class="form-group">
                <label for="companyName">Company Name: </label>
                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name"/>
            </div>

            <div class="form-group">
                <label for="companyregID">Company Registration Number: </label>
                <input type="text" class="form-control" id="companyregID" name="companyregID" placeholder="Enter Company Registration Number"/>
            </div>

            <div class="form-group">
                <label for="yearEnd">Year Ended In: </label>
                <input type="date" class="form-control" id="yearEnd" name="yearEnd"/>
            </div>
            
            <div class="form-group">
                <label for="noOfDirectors">No. of Directors: </label>
                <select name="noOfDirectors" id="noOfDirectors" onchange="addDirectorField(this.value)" required="true">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="directorName1">Director Name #1: </label>
                <input type="text" class="form-control" id="directorName1" name="directorName1" placeholder="Enter Director Name"/>
                <label for="directorName1">Date of Appointment: </label>
                <input type="date" class="form-control" id="directorName1ApptDate" name="directorName1ApptDate"/>
                <label for="directorName1">Director #1 Share: </label>
                <input type="text" class="form-control" id="director1Share" name="director1Share" placeholder="Enter Director's share"/>
                
            </div>
            
            <div class="form-group">
                <label for="todayDate">Today Date: </label>
                <input type="date" class="form-control" id="todayDate" name="todayDate"/>
            </div>
            
            <div class="form-group">
                <label for="firstBalanceDate">First Balance Date: </label>
                <input type="date" class="form-control" id="firstBalanceDate" name="firstBalanceDate"/>
            </div>
            
            <div class="form-group">
                <label for="secondBalanceDate">Second Balance Date: </label>
                <input type="date" class="form-control" id="secondBalanceDate" name="secondBalanceDate"/>
            </div>
            
            <div class="form-group">
                <label for="thirdBalanceDate">Third Balance Date: </label>
                <input type="date" class="form-control" id="thirdBalanceDate" name="thirdBalanceDate"/>
            </div>
            
            <div class="form-group">
                <label for="companyPA">Company's principal activities: </label>
                <input type="textarea" class="form-control" id="companyPA" name="companyPA"/>
            </div>
            
            <div class="form-group">
                <label for="companyAddress">Company's address: </label>
                <input type="text" class="form-control" id="companyAddress" name="companyAddress"/>
            </div>
            
            <div class="form-group">
                <label for="frsDate">Date Company Adopted FRS: </label>
                <input type="date" class="form-control" id="frsDate" name="frsDate"/>
            </div>
            
            <div class="form-group">
                <label for="firstDate">First Date: </label>
                <input type="date" class="form-control" id="firstDate" name="firstDate"/>
            </div>
            
            <div class="form-group">
                <label for="secondDate">Second Date:: </label>
                <input type="date" class="form-control" id="secondDate" name="secondDate"/>
            </div>
            
            <div class="form-group">
                <label for="thirdDate">Third Date:: </label>
                <input type="date" class="form-control" id="thirdDate" name="thirdDate"/>
            </div>
            
            <div class="form-group">
                <label for="currency">Currency: </label>
                <input type="text" class="form-control" id="currency" name="currency" placeholder='E.g. Singapore Dollar'/>
            </div>
            
            <input type="submit" name="preview" class="btn btn-info" value="Preview"/>
            <!--<input type="submit" name="create_word" class="btn btn-info" value="Export to Word" />  -->
        </form>
    </body>
    
<?php include 'footer.php';?>

