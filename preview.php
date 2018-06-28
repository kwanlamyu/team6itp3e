<?php include 'header.php';

// PHPWord dependency
require_once 'D:\Programs\xampp\htdocs\team6itp3e\vendor\autoload.php';

// Creating the new document
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Declare all variables for form
$companyName = $_POST["companyName"];
$companyregID = $_POST["companyregID"];
$yearEnd = $_POST["yearEnd"];
$noOfDirectors = $_POST["noOfDirectors"];
$directorName1 = $_POST["directorName1"];
$directorName1ApptDate = $_POST["directorName1ApptDate"];
$director1Share = $_POST['director1Share'];
$todayDate = $_POST["todayDate"];
$firstBalanceDate = $_POST["firstBalanceDate"];
$secondBalanceDate = $_POST["secondBalanceDate"];
$thirdBalanceDate = $_POST["thirdBalanceDate"];
$companyPA = $_POST["companyPA"];
$companyAddress = $_POST["companyAddress"];
$frsDate = $_POST['frsDate'];
$firstDate = $_POST['firstDate'];
$secondDate = $_POST['secondDate'];
$thirdDate = $_POST['thirdDate'];
$currency = $_POST['currency'];
?>

<body>
    <h1>Cover Page</h1><!-- Temporary-->
    <div name="coverPage">
        <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <p><b><?php echo "(Company registration number: ".$companyregID.")"; ?></p></b>
        <b><p>UNAUDITED FINANCIAL STATEMENTS</p></b>
        <b><?php echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));?></b>

        <?php
        $coverPageFontStyle = new \PhpOffice\PhpWord\Style\Font();
        $coverPageFontStyle->setBold();
        $coverPageFontStyle->setAllCaps();
        $coverPageFontStyle->setName('Arial');
        $coverPageFontStyle->setSize(14);
        
        $section = $phpWord->addSection();
                     
        $coverPageElements = $section->addText($companyName);
        $coverPageElements = $section->addText("(Company registration number:".$companyregID.")");
        $coverPageElements->setFontStyle($coverPageFontStyle);
        
        ?>
        
    </div>
    
    <br>
    <hr> <!-- Temporary-->
    <h1> Page 1</h1><!-- Temporary-->
    <div name="firstPage">
        <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
        if($noOfDirectors > 1){
           echo "DIRECTORS'STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
        }
        else{
           echo "DIRECTOR'S STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
        }
        ?></b>
        <hr>
        <br>
        <br> 
        <textarea>The <?php if($noOfDirectors > 1){ echo "directors";} else{echo "director";}?> present this statement to the member together with the unaudited financial statements of 
        <?php echo strtoupper($companyName)?> (“the Company”) for the financial year ended <?php echo date('F d Y', strtotime($yearEnd));?></textarea>
        <br>
        <ol>
            <li>OPINION OF THE <?php if($noOfDirectors > 1){ echo "DIRECTORS";} else{echo "DIRECTOR";}?></li> 
            <ol type="i">
                <br>
                <li>the accompanying financial statements of the Company are drawn up so as to give a true and fair view of the 
                    financial position of the Company as at <?php echo date('F d Y', strtotime($yearEnd));?> and the financial performance, changes in equity and 
                    cash flows of the Company for the financial year covered by the financial statements; and </li>
                <br>
                <li>at the date of this statement there are reasonable grounds to believe that the Company will be able to pay its debts as and when they fall due.</li>
                <br>
            </ol>
            <li><?php if($noOfDirectors > 1){ echo "DIRECTORS";} else{echo "DIRECTOR";}?></li>
            <br>
            The <?php if($noOfDirectors > 1){ echo "directors";} else{echo "director";}?> of the Company in office at the date of this statement are as follows:
            <br><br>
            <?php if($directorName1ApptDate != null){echo $directorName1." appointed on ".date('F d Y', strtotime($directorName1ApptDate));} else{echo $directorName1;}?>
            <br>
            <br>
            <li>ARRANGEMENTS TO ENABLE <?php if($noOfDirectors > 1){ echo "DIRECTORS";} else{echo "DIRECTOR";}?>  TO ACQUIRE SHARES AND DEBENTURES</li>
            <br>
            <p>Neither at the end of nor at any time during the financial year was the Company a party to any arrangement whose object was to enable the <?php if($noOfDirectors > 1){ echo "directors";} else{echo "director";}?> of the 
                Company to acquire benefits by means of the acquisition of shares in, or debentures of, the Company or any other body corporate.
            </p>
            <li><?php if($noOfDirectors > 1){ echo "DIRECTORS'";} else{echo "DIRECTOR'S";}?> INTERESTS IN SHARES OR DEBENTURES</li>
            <br>
            <p>According to the register of <?php if($noOfDirectors > 1){ echo "directors'";} else{echo "director's";}?> shareholdings, none of the 
                <?php if($noOfDirectors > 1){ echo "directors'";} else{echo "director's";}?> holding office at the end of the 
                financial year had any interest in the shares or debentures of the Company or its related corporations, <?php if ($director1Share != " "){ echo "except as follows:";}?> </p>
            <br>
            <br>
            <p><u>The Company</u><br><?php echo $directorName1;?></p>            
        </ol>
    </div>
    <h1> Page 2</h1><!-- Temporary-->
    <div name="secondPage">
        <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
        if($noOfDirectors > 1){
           echo "DIRECTORS'STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
        }
        else{
           echo "DIRECTOR'S STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
        }
        ?></b>
        <hr>
        <br>
        <br> 
        <ol start="5">
            <li><?php if($noOfDirectors > 1){ echo "DIRECTORS'";} else{echo "DIRECTOR'S";}?> CONTRACTUAL BENEFITS</li>
            <br>
            <p>Since the end of the previous financial period, no director has received or become entitled to receive a benefit which is required to be disclosed 
             under the Singapore Companies Act, by reason of a contract made by the Company or a related corporation with the directors or with a firm of which 
             he is a member, or with a Company in which he has a substantial financial interest, except as disclosed in the financial statements. </p>
            <br>
            
            <li>OPTIONS GRANTED</li>
            <br>            
            <p>No options were granted during the financial year to subscribe for unissued shares of the Company.</p>
            
            <br>
            <li>OPTIONS EXERCISED</li>
            <br>
            <p>No shares were issued during the financial year by virtue of the exercise of options to take up unissued shares of the Company.</p>
            
            <br>
            <li>OPTIONS OUTSTANDING</li>
            <br>
            <p>There were no unissued shares of the Company under option at the end of the financial year.</p>
            <br>
        </ol>
        <p><?php if($noOfDirectors >= 2){echo "On behalf of the directors";}?></p>
        <br>
        <br>
        <p><?php echo $directorName1;?><br>Director</p>
        <br>
        <p><?php echo "Singapore, ".(date('F d Y', strtotime($todayDate)))?></p>
    </div>
    <h1> Page 3</h1>
    <div name="thirdPage">
        <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "STATEMENT OF COMPREHENSIVE INCOME";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <p>Revenue</p>
        <p>Less: Cost of Sales</p>
        <p><b>Gross Profit</b></p>
        <p>Other income</p>
        <p>Expenses<br>
            -Administrative<br>
            -Distribution and marketing<br>
            -Finance<br>            
        </p>
        <p><b>Profit before income tax</b></p>
        <p>Income tax expense</p>
        <p><b>Net profit and total comprehensive income for the year/period</b></p>
        <br>
        <br>
        <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>      
    </div>
    <h1> Page 4</h1>
    <div name="fourthPage">
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "STATEMENT OF FINANCIAL POSITION";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <p><b>ASSETS</b><br>
            <b>Current Assets</b><br>
            Bank balances<br>
            Trade and other receivables<br>           
        </p>
        <p><b>Non-current assets</b><br>
            Plant and equipment<br>
        </p>
        <p><b>Total assets</b></p>
        <p><b>LIABILITIES</b><br>
            <b>Current liabilities</b><br>
            Trade and other payables<br>
            Current income tax liabilities<br>
            Borrowings<br>
        </p>
        <p><b>Total liabilities</b></p>
        <p><b>Non-current liabilities</b><br>
             Borrowings<br>      
        </p>
        <p><b>Total liabilities</b></p>
        <p><b>NET ASSETS</b></p>
        <p><b>EQUITY</b><br>
            Share capital<br>
            Retained profits
        </p>
        <p><b>Total equity</b></p>
        <br>
        <br>
        <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>      
    </div>
    <h1> Page 5</h1>
    <div name="fifthPage">
        <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "STATEMENT OF CHANGES IN EQUITY";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>  
        <p><?php echo "Balance as at ".date('F d Y', strtotime($firstBalanceDate));?></p>
        <p>Total comprehensive income  for the  financial period</p>
        <p><?php echo "Balance as at ".date('F d Y', strtotime($secondBalanceDate));?></p>
        <p>Issuance of ordinary shares</p>
        <p>Total comprehensive income  for the  financial year</p>
        <p><?php echo "Balance as at ".date('F d Y', strtotime($thirdBalanceDate));?></p>
        <br>
        <br>
        <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>  
    </div>
    <h1> Page 6</h1>
    <div name="sixthPage">
     <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "STATEMENT OF CASH FLOWS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <p><b>Cash flows from operating activities:</b><br>
            Profit  before income tax<br>
            Adjustment for:<br>
            &emsp;Depreciation<br>
            &emsp;Interest on bank borrowings<br>
        </p>
        <p>Change in working capital:<br>
            &emsp;Trade and other receivables<br>
            &emsp;Trade and other payables 
        </p>
        <p>Cash generated from  operations</p>
        <p>Income tax paid</p>
        <p><b>Net cash generated from  operating activities</b></p>
        <br>
        <p><b>Cash flows from investing activities</b><br>
            Additions to plant  and equipment 
        </p>
        <p><b>Net cash used in  investing activities</b><br>
            Proceeds from issuance of ordinary shares<br>
            (Advances)/repayment  from a shareholder<br>
            Proceeds from borrowings<br>
            Repayments of borrowings<br>
            Interest paid<br>
        </p>
        <p><b>Net cash (used in)/generated  from financing activities</b></p>
        <p>Net increase  in cash and cash equivalents<br>
            Cash and cash equivalents at beginning of the financial year/period
        </p>
        <p><b>Cash and cash equivalents at end of the financial year/period</b></p>
        <br>
        <br>
        <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>
    </div>
    <h1>Page 7</h1>
    <div name="seventhPage">
        <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <p>These notes form an integral part of and should be read in conjunction with the accompanying financial statements.</p>
        <br>
        <p>
        <ol>
            <li>GENERAL INFORMATION</li><br>
            <p>The Company is incorporated and domiciled in Singapore.</p>
            <p>The Company’s principal activities are those to carry-on the businesses of <?php echo $companyPA?></p> 
            <p>The Company’s registered office is at <?php echo $companyAddress?></p>
            <p>The financial statements of the Company for the financial year ended <?php echo date('F d Y', strtotime($yearEnd))?>
            were authorised for issue in accordance with a resolution of the directors on the date of Statement by Directors.</p>
            
            <li>BASIS OF PREPARATION AND SUMMARY OF SIGNIFICANT ACCOUNTING POLICIES</li><br>
            <ol type='i'>
                <li>Basis of preparation</li><br>
                <ol type='a'>
                    <li>Basis of accounting</li><br>
                    <p>The financial statements are prepared in accordance with Singapore Financial Reporting Standards (“FRS”). 
                        The financial statements have been prepared under the historical cost convention, except as disclosed in the accounting policies below.</p>
                    <p>The preparation of these financial statements in conformity with FRS requires management to exercise its judgement in the process of applying the 
                        Company’s accounting policies. It also requires the use of certain critical accounting estimates and assumptions. The areas involving a higher degree of 
                        judgement or complexity,or areas where assumptions and estimates are significant to the financial statements, are disclosed in Note 3</p>
                    <li>Adoption of new and revised Singapore Financial Reporting Standards </li><br>
                    <p>On <?php echo date('F d Y', strtotime($frsDate));?> the Company adopted the new or amended FRS and Interpretations to FRS (“INT FRS”) that are mandatory for application for the financial year. 
                        The adoption of these new or amended FRS and INT FRS did not result insubstantial changes of the Company’s accounting policies and had no material effect on the 
                        amounts reported for the current or prior financial period.</p>
                </ol>
            </ol>
        </ol>
        </p>
        <br>
        <br>
    </div>
    <h1> Page 8</h1>
    <div name='eigthPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <p>
        <ol start='2'>
            <ol type='i' start='2'>
                <li>Summary of significant accounting policies</li><br>
                <ol type='a'>
                    <li>Revenue recognition</li><br>
                    <p>Sales comprise the fair value of the consideration received or receivable for the rendering of services in the 
                        ordinary course of the Company’s activities. Sales are presented net of goods and services tax, rebates and discounts.</p>
                    <p>The Company recognises revenue when the amount of revenue and related cost can be reliably measured, when it is probable that the 
                        collectability of the related receivables is reasonably assured and when the specific criteria for each of the Company’s activities are met.</p>
                    <ol type='i'> <!-- need to change to dynamic-->
                        <li>Service income</li><br>
                        <p>Service income is recognised when services are rendered.</p>
                        <li>Sale of goods </li><br>
                        <p>Revenue from these sales is recognised when a Company has delivered the products to the customer, 
                           the customer has accepted the products and collectability of the related receivables is reasonably assured.</p>
                    </ol>
                    <li>Employee compensation</li><br>
                    <p>Employee benefits are recognised as an expense, unless the cost qualifies to be capitalised as an asset.</p>
                    <ol type='i'>
                        <li>Defined contribution plans</li><br>
                        <p>Defined contribution plans are post-employment benefit plans under which the Company pays fixed contributions into separate entities such as the 
                            Central Provident Fund on a mandatory, contractual or voluntary basis. The Company has no further payment obligations once the contributions have been paid.</p>
                        <li>Employee leave entitlement</li><br>
                        <p>Employee entitlements to annual leave are recognised when they accrue to employees. A provision is made for the estimated liability for annual leave as a result of 
                            services rendered by employees up to the balance sheet date.</p>
                    </ol>
                    <li>Operating lease payments</li><br>
                    <p>Payments made under operating leases (net of any incentives received from the lessor) are recognized in profit or loss on a straight-line basis over the period of lease.</p>
                    <p>Contingent rents are recognised as an expense in profit or loss when incurred.</p>
                </ol>
            </ol>
        </ol>    
        </p>
        <br>
        <br>
    </div>
    <h1> Page 9</h1>
    <div name='ninthPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>  
         <ol start='2'>
             <ol type='i' start='2'>
                 <li>Summary of significant accounting policies (Cont’d)</li><br>
                 <ol type='a' start='4'>
                     <li>Borrowing costs</li><br>
                     <p>Borrowing costs are recognised in profit or loss using the effective interest method</p>
                     
                     <li>Income taxes </li><br>
                     <p>Current income tax for current and prior periods is recognised at the amount expected to be paid to or recovered from the tax authorities, 
                         using the tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date</p>
                     <p>Deferred income tax is recognised for all temporary differences arising between the tax bases of assets and liabilities and their carrying 
                         amounts in the financial statements except when the deferred income tax arises from the initial recognition of an asset or liability that 
                         affects neither accounting nor taxable profit or loss at the time of the transaction.</p>
                     <p>A deferred income tax asset is recognised to the extent that it is probable that future taxable profit will be available against which the 
                         deductible temporary differences and tax losses can be utilised.</p>
                     <p>Deferred income tax is measured:</p>
                     
                     <ol type='i'>
                         <li>at the tax rates that are expected to apply when the related deferred income tax asset is realised or the deferred income 
                             tax liability is settled, based on tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date; and</li><br>
                         <li>based on the tax consequence that will follow from the manner in which the Company expects, at the balance sheet date, to recover or settle 
                             the carrying amounts of its assets and liabilities.</li><br>
                     </ol>
                     <p>Current and deferred income taxes are recognised as income or expense in profit or loss.</p>
                     
                     <li>Inventories </li><br> <!-- only applicable if inventory is in balance sheet-->
                     <p>Inventories are carried at the lower of cost and net realisable value. Cost is determined using the first-in, first-out method. Net realisable value 
                         is the estimated selling price in the ordinary course of business, less applicable variable selling expenses.</p>
                 </ol>
             </ol>
         </ol>
        <br>
        <br>
    </div>
    <h1> Page 10</h1>
    <div name='tenthPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <ol start='2'>
             <ol type='i' start='2'>
                 <li>Summary of significant accounting policies (Cont’d)</li><br>
                 <ol type='a' start='7'>
                     <li>Plant and equipment</li><br>
                     <ol type='i'>
                         <li>Measurement</li><br>
                         <p>Plant and equipment are initially recognised at cost and subsequently carried at cost less accumulated depreciation and accumulated impairment losses</p>
                         <p>The cost of an item of plant and equipment initially recognised includes its purchase price and any cost that is directly attributable to bringing the 
                             asset to the location and condition necessary for it to be capable of operating in the manner intended by management.</p>
                         
                         <li>Depreciation</li><br>
                         <p>Depreciation on plant and equipment is calculated using the straight-line method to allocate their depreciable amounts over their estimated useful lives as follows:</p>
                         
                         <!-- need to create table by form generation-->
                         <p>&emsp;Computer and softwares <br>
                            &emsp;Office equipment<br>
                         </p>
                         <p>The residual values, estimated useful lives and depreciation method of plant and equipment are reviewed, and adjusted as appropriate, at the end of each reporting period. 
                             The effects of any revision are recognised in profit or loss when the changes arise.</p>
                         <p>Fully depreciated plant and equipment still in use are retained in the financial statements.</p>
                         
                         <li>Subsequent expenditure</li><br>
                         <p>Subsequent expenditure relating to plant and equipment that has already been recognised is added to the carrying amount of the asset only when it is probable that future 
                             economic benefits associated with the item will flow to the Company and the cost of the item can be measured reliably. All other repair and maintenance expenses are recognised in profit or loss when incurred.</p>
                         
                         <li>Disposal</li><br>
                         <p>On disposal of an item of plant and equipment, the difference between the disposal proceeds and its carrying amount is recognised in profit or loss.</p>
                     </ol>
                 </ol>
             </ol>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 11</h1>
    <div name='eleventhPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <ol start='2'>
             <ol type='i' start='2'>
                 <li>Summary of significant accounting policies (Cont’d)</li><br>
                 <ol type='a' start='8'>
                     <li>Impairment of non-financial assets</li><br>
                     <p>Non-financial assets are tested for impairment whenever there is any objective evidence or indication that these assets may be impaired.</p>
                     <p>For the purpose of impairment testing, the recoverable amount (i.e. the higher of the fair value less cost to sell and the value-in-use) is determined on an 
                         individual asset basis unless the asset does not generate cash flows that are largely independent of those from other assets. If this is the case, the 
                         recoverable amount is determined for the CGU to which the asset belongs.</p>
                     <p>If the recoverable amount of the asset (or CGU) is estimated to be less than its carrying amount, the carrying amount of the asset (or CGU) is reduced to 
                         its recoverable amount.</p>
                     <p>The difference between the carrying amount and recoverable amount is recognised as an impairment loss in profit or loss.</p>
                     <p>An impairment loss for an asset is reversed only if, there has been a change in the estimates used to determine the asset’s recoverable amount since the last 
                         impairment loss was recognised. The carrying amount of this asset is increased to its revised recoverable amount, provided that this amount does not exceed 
                         the carrying amount that would have been determined (net of any accumulated amortisation or depreciation) had no impairment loss been recognised for the asset in prior years.</p>
                     <p>A reversal of impairment loss for an asset is recognised in profit or loss.</p>
                     
                     <li>Financial assets</li><br>
                     <ol type='i'>
                         <li>Classification</li><br>
                         <p>The classification of financial assets depends on the purpose for which the assets were acquired. Management determines the classification of its financial 
                             assets at initial recognition. </p>
                         <p>Loans and receivables</p>
                         <p>Loans and receivables are non-derivative financial assets with fixed or determinable payments that are not quoted in an active market. They are presented as current assets, 
                             except for those maturing later than 12 months after the end of financial reporting date which are presented as non-current assets. Loans and receivables are presented as 
                             “trade receivables” and “cash and bank balances” on the statement of financial position.</p>
                     </ol>

                 </ol>
             </ol>
            <br>
            <br>
    </div>
    <h1> Page 12</h1>
    <div name='twelvePage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <ol start='2'>
             <ol type='i' start='2'>
                 <li>Summary of significant accounting policies (Cont’d)</li><br>
                 <ol type='a' start='8'> 
                     <li>Financial assets (Cont’d)</li><br>
                     <ol type='i' start='2'>
                         <li>Recognition and derecognition</li><br>
                         <p>Regular way purchases and sales of financial assets are recognised on trade-date - the date on which the Company commits to purchase or sell the asset.</p>
                         <p>Financial assets are derecognised when the rights to receive cash flows from the financial assets have expired or have been transferred and the Company has 
                             transferred substantially all risks and rewards of ownership. On disposal of a financial asset, the difference between the carrying amount and the sale 
                             proceeds is recognised in the profit or loss.</p>
                         
                         <li>Initial measurement </li><br>
                         <p>Financial assets are initially recognised at fair value plus transaction costs.</p>
                         
                         <li>Subsequent measurement</li>
                         <p>Loans and receivables and financial assets are subsequently carried at amortised cost using the effective interest method.</p>
                         
                         <li>Impairment</li>
                         <p>The Company assesses at each end of financial reporting date whether there is objective evidence that a financial asset or a group of financial assets is impaired 
                             and recognises an allowance for impairment when such evidence exists. </p>
                         <p>Loans and receivables </p>
                         <p>Significant financial difficulties of the debtor, probability that the debtor will enter bankruptcy, and default or significant delay in payments are objective 
                             evidence that these financial assets are impaired. </p>
                         <p>The carrying amount of these assets is reduced through the use of an impairment allowance account, which is calculated as the difference between the carrying amount
                             and the present value of estimated future cash flows, discounted at the original effective interest rate. When the asset becomes uncollectible, it is written off 
                             against the allowance account. Subsequent recoveries of amounts previously written off are recognised against the same line item in the income statement.</p>
                         <p>The allowance for impairment loss account is reduced through the profit or loss in a subsequent period when the amount of impairment loss decreases and the related 
                             decrease can be objectively measured. The carrying amount of the asset previously impaired is increased to the extent that the new carrying amount does not exceed 
                             the amortised cost, had no impairment been recognised in prior periods.</p>
                     </ol>
                 </ol>
             </ol>
            <br>
            <br>
    </div>
    <h1> Page 13</h1>
    <div name='thirteenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <ol start='2'>
             <ol type='i' start='2'>
                 <li>Summary of significant accounting policies (Cont’d)</li><br>
                 <ol type='a' start='10'>
                     <li>Trade and other payables</li><br>
                     <p>Trade and other payables represent liabilities for goods and services provided to the Company prior to the end of financial year which are unpaid. They are classified 
                         as current liabilities if payment is due within one year or less (or in the normal operating cycle of the business if longer). Otherwise, they are presented as non-current 
                         liabilities.</p>
                     
                     <!-- check if borrowing is in balance sheet-->
                     <li>Borrowings </li><br>
                     <p>Borrowings are presented as current liabilities unless the Company has an unconditional right to defer settlement for at least 12 months after the balance sheet date, in 
                         which case they are presented as non-current liabilities.</p>
                     <p>Borrowings are initially recognised at fair value (net of transaction costs) and subsequently carried at amortised cost. Any difference between the proceeds (net of transaction costs) 
                         and the redemption value is recognised in profit or loss over the period of the borrowings using the effective interest method.</p>
                     
                     <li>Cash and cash equivalents</li><br>
                     <p>For the purpose presentation in the statement of cash flows, cash and cash equivalents include deposits with financial institutions which are subject to an insignificant risk of change 
                         in value.</p>
                     
                     <li>Cash and cash equivalents</li><br>
                     <p>Dividends to the Company’s shareholders are recognized when the dividends are approved for payment.</p>
                     
                     <li>Currency translation</li><br>
                     <ol type='i'>
                         <li>Functional and presentation currency</li><br>
                         <p>Items included in the financial statements of the Company are measured using the currency of the primary economic environment in which the Company operates (‘the functional currency’). 
                             The financial statements are presented in Singapore Dollar, which is the Company’s functional and presentation currency</p>
                     </ol>
                 </ol>
             </ol>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 14</h1>
    <div name='fourteenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br>
        <ol start='3'>
             <ol type='i' start='2'>
                 <li>Summary of significant accounting policies (Cont’d)</li>
                 <ol type='a' start='14'>  
                     <li>Currency translation (Cont’d)</li><br>
                     <ol type='i' start='2'>
                         <li>Transactions and balances </li><br>
                         <p>Transactions in a currency other than the functional currency (“foreign currency”) are translated into the functional currency using the exchange rates at the dates of the transactions. 
                             Currency translation differences from the settlement of such transactions and from the translation of monetary assets and liabilities denominated in foreign currencies at the closing rates 
                             at the end of financial reporting date are recognised in the profit or loss, unless they arise from borrowings in foreign currencies, other currency instruments designated and qualifying as 
                             net investment hedges and net investment in foreign operations. Those currency translation differences are recognised in the currency translation reserve in the financial statements and 
                             transferred to profit or loss as part of the gain or loss on disposal of the foreign operation.</p>
                     </ol>
                     
                     <li>Share capital </li><br>
                     <p>Ordinary shares are classified as equity. Incremental costs directly attributable to the issuance of new ordinary shares are deducted against the share capital account.</p>
                 </ol>
            </ol>
            <li>CRITICAL ACCOUNTING ESTIMATES, ASSUMPTIONS AND JUDGEMENTS</li><br>
                 <p>Estimates, assumptions and judgements are continually evaluated and are based on historical experience and other factors, including expectations of future events that are believed to be reasonable under the circumstances.</p>
                 
                 <ol type='a'>
                     <li>Critical accounting estimates and assumptions</li><br>
                     <p>During the financial year, the management did not make any critical estimates and assumptions that had a significant effect on the amounts recognised in the financial statements</p>
                     
                     <li>Critical judgements in applying the Company’s accounting policies</li><br>
                     <p>In the process of applying the Company’s accounting policies, the directors are of the opinion that there is no application of critical judgement on the amounts recognised in the financial statements.</p>
                 </ol>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 15</h1>
    <div name='fifteenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='4'>
            <li>OTHER INCOME</li><br>
            <p>Realised exchange gain - trade</p>
            <p>Unrealised exchange gain</p>
            
            <li>PROFIT BEFORE INCOME TAX</li><br>
            <p>This is determined after charging: <br>
                Depreciation of plant and equipment (Note 11)<br>
                Employee’s compensation (Note 7)<br>
                Realised exchange loss - trade</p>
            
            <li>FINANCE EXPENSE</li><br>
            <p>Interest expense on bank borrowings</p>
            
            <li>EMPLOYEE COMPENSATION</li><br>
            <p>Director’s remuneration <br>
                Salaries <br>
                Other benefits</p>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 16</h1>
    <div name='sixteenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='8'>
            <li>INCOME TAXES</li><br>
            <ol type='a'>
                <li>Income tax expense</li><br>
                <p>Tax expense attributable to profit is made up of:<br>
                    Current income tax expenses<br>
                    Under provision in prior year</p>
                <p>The tax expense on profit differs from the amount that would arise using the Singapore standard rate of income tax as follows:</p>
                <p>Profit  before income tax</p>
                
                <p>Tax calculated at tax rate of 17% (2015: 17%)<br>
                    Effects of:<br>
                    - expenses not deductible for tax purposes<br>
                    - income not subject to tax <br>
                    - deferred tax liabilities not recognised <br> 
                    - Capital and PIC enhanced allowances <br>
                    - tax exemption <br>
                    - CIT rebate <br>
                    - under provision in prior year</p>
                <p>Tax expense</p>
                
                <li>Movement in current income tax liabilities:</li><br>
                <p>Beginning of financial year <br>
                    Income tax paid<br>
                    Current year tax expense<br>
                    Under provision in prior year<br>
                    End of financial year</p>
            </ol>
        </ol> 
        <br>
        <br>
    </div>
    <h1> Page 17</h1>
    <div name='seventeenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='9'>   
            <li>TRADE AND OTHER RECEIVABLES</li><br>
            <p>Trade receivables</p>
            <p>Deposits <br>
                Prepayments <br>
                Amount owing from a shareholder</p>
            <p>The amount owing from a shareholder is unsecured, non-trade, interest free and repayable on demand.</p>
            
            <li>PLANT AND EQUIPMENT </li><br>
            <p><b>Cost:</b><br>
                As at <?php echo date('F d Y', strtotime($firstDate))?><br>
                Additions<br>
                As at <?php echo date('F d Y', strtotime($secondDate))?><br>
                Additions<br>
                As at <?php echo date('F d Y', strtotime($thirdDate))?><br>
            </p>
            <p><b>Accumulated depreciation:</b><br>
                As at <?php echo date('F d Y', strtotime($firstDate))?><br>
                Charge for the financial period<br>
                As at <?php echo date('F d Y', strtotime($secondDate))?><br>
                Charge for the financial year<br>
                As at <?php echo date('F d Y', strtotime($thirdDate))?><br>                 
            </p>
            <p><b>Net book value:</b><br>
                As at <?php echo date('F d Y', strtotime($thirdDate))?><br> 
                As at <?php echo date('F d Y', strtotime($secondDate))?><br>
            </p>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 18</h1>
    <div name='eighteenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='11'> 
            <li>TRADE AND OTHER PAYABLES</li><br>
            <p>Trade payables</p>
            <p><u>Other payables</u><br>
                GST payables<br>
                Accruals<br>
                Amount owing to a shareholder</p>
            
            <li>BORROWINGS</li><br>
            <p>As at beginning of financial year</p>
            <p>Proceeds from borrowings<br>
                Less: Repayment of borrowings</p>
            <p>As at end of financial year</p>
            <p>Current<br>
                Non-current</p>

            <li>SHARE CAPITAL</li><br>
            <p>Issued and fully paid:<br>
                At beginning of financial year<br>
                Issuance of ordinary shares</p>
            <p>At end of financial  year/period</p>
            <p>All issued ordinary shares are fully paid. The newly issued shares rank pari passu in all respects with the previously issued shares. There is no par value for the ordinary share. The holder of the ordinary share
                is entitled to receive dividends as and when declared by the Company.</p>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 19</h1>
    <div name='nineteenPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='14'>
            <li>FINANCIAL RISK MANAGEMENT</li><br>
            <p>The Company’s activities expose it to a variety of financial risks. The Company’s overall business strategies, tolerance risk and general risk management philosophy are determined by directors in accordance with 
                prevailing economic and operating conditions. </p>
            
            <p><u>Currency risk</u></p>
            <p>The Company’s exposure to foreign exchange risk is minimal as transactions are predominantly denominated in <?php echo $currency;?>, being the functional currency of the Company.</p>
        
            <p><u>Interest rate risk</u></p>
            <p>Cash flow interest rate risk is the risk that the future cash flows of a financial instrument will fluctuate because of changes in market interest rates. Fair value interest rate risk is the risk that the fair 
                value of a financial instrument will fluctuate due to changes in market interest rates. As the Company has no significant interest bearing assets or liabilities, the Company’s income and operating cash flows 
                are substantially independent of changes in market interest rates.</p>
            
            <p><u>Liquidity risk</u></p>
            <p>Prudent liquidity management implies maintaining sufficient cash and the availability of funding through an adequate amount of committed credit facilities. The Company maintains sufficient cash balances to 
                provide flexibility in meeting its day to day funding requirements. Cash and cash equivalents are placed with credit worthy institutions.</p>
            <p>The Company’s financial liabilities are due less than 1 year based on the remaining period from the reporting date to the contractual maturity date.  Balances due within 12 months equal their carrying balances 
                as the impact of discounting is not significant.</p>
            
            <p><u>Fair value measurements</u></p>
            <p>The Company does not have any financial instruments as at end of the financial year which are measured at fair value. The carrying values of other receivables and other payables are assumed to approximate 
                their fair values.</p>
            
            <p><u>Credit risk</u></p>
            <p>Credit risk is the risk that companies and other parties will be unable to meet their obligations to the Company resulting in financial loss to the Company. The Company manages such risks by dealing with a 
                diverse of credit-worthy counterparties to mitigate any significant concentration of credit risk. Credit policy includes assessing and evaluation of existing and new customers' credit reliability and monitoring 
                of receivable collections. The Company places its cash and cash equivalents with creditworthy institutions.</p>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 20</h1>
    <div name='twentyPage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='14'>
            <li>FINANCIAL RISK MANAGEMENT (CONT’D)</li><br>
            <p><u>Credit risk (Cont’d)</u></p>
            <p>The maximum exposure to credit risk in the event that the counterparties fail to perform the obligations as at the end of the financial period in relation to each class of financial assets is the carrying 
                amount of these assets in the statement of financial position.</p>
            <p>The credit risk for receivables based on the information provided to key management is as follows:</p>
            
            <ol type='i'>
                <li>Financial assets that are neither past due nor impaired</li><br>
                <p>Bank deposits that are neither past due nor impaired are mainly deposits with banks with high credit-ratings assigned by international credit-rating agencies. Other receivables that are neither past due 
                    nor impaired are substantially companies with a good collection track record with the Company.</p>
                
                <li>Financial assets that are past due and/or impaired</li><br>
                <p>There is no other class of financial assets that is past due and/or impaired.</p><br>
            </ol>
            
            <p><u>Capital risk</u></p>
            <p>The Company’s objectives when managing capital are:</p>
            <ul>
                <li>to safeguard the Company’s ability to continue as a going concern, so that it can continue to provide returns for shareholders and benefits for other stakeholders, and</li>
                <li>to provide an adequate return to shareholders by pricing products and services commensurately with the level of risk.</li>
            </ul>
            
            <p>The capital structure of the Company consists primarily of equity, comprising issued share capital.</p>
            <p>The Company manages its capital structure and makes adjustment to it in light of changes in economic conditions. It may maintain or adjust its capital structure through the payment of dividends, return of capital 
                or issue of new shares.  </p>

            <li>RELATED PARTY TRANSACTIONS</li><br>
            <p>	Related parties comprise mainly of companies which are controlled or significantly influenced by the Company’s key management personnel and their close family members.</p>
            <p>Key management personnel of the Company are those persons having the authority and responsibility for planning, directing and controlling activities of the Company.  The directors and executive officers of the 
                Company are considered as key management personnel of the Company.</p>
        </ol>
        <br>
        <br>
    </div>
    <h1> Page 21</h1>
    <div name='twentyonePage'>
    <b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "NOTES TO THE FINANCIAL STATEMENTS";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br> 
        <ol start='15'> 
            <li>RELATED PARTY TRANSACTIONS (CONT’D)</li><br>
            <p>The inter-company balances are unsecured and interest-free, unless stated otherwise, and are subject to the normal credit terms of the respective parties and are 
                repayable on demand.</p>
            
            <p><u>Key management personnel compensation</u></p>
            <p>Director’s remuneration</p>
            
            <li>NEW OR REVISED ACCOUNTING STANDARDS AND INTERPRETATIONS </li><br>
            <p>Certain new standards, amendments and interpretations to existing standards have been published and are mandatory for the Company’s accounting periods beginning on 
                or after 1 January 2017  or later periods and which the Company has not early adopted.</p>
            <!-- set as first date of next financial year-->
            
            
            <li>COMPARATIVE FIGURES </li><br>
            <p>The management anticipates that the adoption of the new amendments to FRS in the future periods will not have a material impact on the financial statements of the 
                Company and of the Company in the period of their initial adoption.</p>
            
            <li>COMPARATIVE FIGURES </li><br>
            <p>The financial statements cover the financial period since incorporation on 1 July 2014 to 31 December 2015. This being the first set of financial statements, 
                there are no comparative. </p>
        </ol>
        <br>
        <br>
        <p>-------------------------------- End of unaudited financial statements --------------------------------</p>
    </div>
    <h1> Page 22</h1>
    <div name='twentytwoPage'>
    <center><b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "DETAILED INCOME STATEMENT";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br></center> 
        <p>Revenue</p>
        <p>Less: Cost of sales<br>
            <b>Gross profit</b></p>
        <p><u>Add: Other income:</u><br>
            Exchange gain - trade<br>
            Exchange gain - non-trade</p>
        <p><u>Less: Expenses</u>
            Administrative expenses (Appendix II)<br>
            Distribution and marketing expenses (Appendix II)<br>
            Finance expense (Appendix II)</p>
        <p><b>Profit before income  tax</b></p>
        <br>
        <br>
        <p><center>Does not form part of the unaudited financial statements </center></p>    
    </div>
    <h1> Page 23</h1>
    <div name='twentythreePage'>
    <center><b><?php echo strtoupper($companyName);?></b>
        <br/>
        <b><?php
           echo "DETAILED INCOME STATEMENT";
           echo "<br>";
           echo "FOR THE FINANCIAL YEAR ENDED ".strtoupper(date('F d Y', strtotime($yearEnd)));
           ?></b>
        <hr>
        <br>
        <br></center>
        <p><u>Administrative expenses</u><br>
            Accounting fee<br>
            Administrative expenses<br>
            Bank charges<br>
            Compilation fee<br>
            Depreciation<br>
            Director’s remuneration<br>
            Director’s remuneration<br>
            Employment pass<br>
            Exchange loss - trade<br>
            Freight charges<br>
            Insurance<br>
            Internet expenses<br>
            Late penalty<br>
            Nominee director fee<br>
            Office supplies<br>
            Postage and courier<br>
            Professional fee<br>
            Printing and stationery<br>
            Rental<br>
            Salaries<br>
            Secretarial fee<br>
            Skill development levy & SINDA<br>
            Taxation fee
        </p>
        <p><u>Distribution and marketing expenses</u><br>
                Travelling expenses<br>
                Transportation<br>	
                Telephone expenses<br></p>
        <p><u>Finance expenses</u><br>
            Interest on bank borrowings</p>
    </div>
</body>



<?php 
include 'footer.php';

// Saving the document as OOXML file
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('preview.docx');

?>

