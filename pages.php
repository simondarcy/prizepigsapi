<?php
/* 
pages.php
Simply static pages to be used in app etc
*/

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$waysBody = <<<'EOD'
<p class="excerpt">There are the many ways you can win great prizes with Prize Pigs</p>
<p class="title">By simply signing up to Prize Pigs</p>
<p>That's right! When sign up to Prize Pigs you are automatically entered into our "New Piglet Draw" which takes place at the end of each month.</p>
<p class="title">Entering our many competitions</p>
<p>We are always adding new competitions so remember to keep an eye out on our apps and <a href="https://www.prizepigs.ie">site</a>. Also remember to like us on <a href="https://www.facebook.com/prizepigs/">Facebook</a> and follow us on <a href="https://www.twitter.com/prizepigs/">Twitter</a>.</p>
<p class="title">By entering any competition</p>
<p>At the end of each month we run an "Eager Pig draw" for everyone who entered a competition in the previous month.</p>
<p class="title">By not winning</p>
<p>Didn't win any of the prizes you went in for? Not to worry, not winning qualifies you for our monthly "Unlucky Pig Draw".</p>
<p class="title">By spreading the word</p>
<p>Each month we will run a draw for everyone that shared, liked, followed or mentioned us on social media. #prizepigs @prizepigs</p>
<p class="title">Spot Prizes</p>
<p>If that's not enough... We also run spot competitions when we're feeling even more generous than usual. So keep an eye on your inbox.</p>
EOD;

$privacyBody = <<<'EOD'
<p class="title">What personal information do we collect from the people that visit our website or app?</p>
<p>When registering, as appropriate, you will be asked to enter your email address, DOB and gender to help you with your experience.
</p>
<p class="title">When do we collect information?</p>
<p>We collect information from you when you register on our site or mobile app.</p>
<p class="title">How do we use your information?</p>
<p>We may use the information we collect from you when you register in the following ways:
<ul>
<li>To administer a contest, promotion, survey or other site feature.</li>
<li>To send periodic emails regarding competitions and giveaways.</li>
</ul>
</p>
<p class="title">How do we protect visitor information?</p>
<p>Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all information you supply is encrypted via Secure Socket Layer (SSL) technology.</p>
<p>We implement a variety of security measures when a user enters, submits, or accesses their information to maintain the safety of your personal information.</p>
<p>Our server is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible.</p>
<p>We use regular Malware Scanning.</p>
<p class="title">Do we use "Cookies"?</p>
<p>Yes. Cookies are small files that a site or its service provider transfers to your computer's hard drive through your Web browser (if you allow) that enables the site's or service provider's systems to recognise your browser, capture and remember certain information. </p>
<p>You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser (like Internet Explorer) settings. Each browser is a little different, so look at your browser's Help menu to learn the correct way to modify your cookies.</p>
<p>If you disable cookies, you will be unable to login or register to our site / app therefor you will not be able to enter into our competitions.</p>
<p class="title">We use cookies to:</p>
<p>Remember you so you don't have to login to the site each time you visit.</p>
<p>Compile aggregate data about site traffic and site interactions in order to offer better site experiences and tools in the future. We may also use trusted third party services that track this information on our behalf.</p>
<p class="title">Third Party Disclosure</p>
<p>We do not sell, trade, or otherwise transfer to outside parties your personally identifiable information unless we provide you with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential. We may also release your information when we believe release is appropriate to comply with the law, enforce our site policies, or protect ours or others' rights, property, or safety.</p>
<p>However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.</p>
<p class="title">Third Party Links</p>
<p>Occasionally, at our discretion, we may include or offer third party products or services on our website / app. These third party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</p>
<p class="title">Does our site allow third party behavioural tracking?</p>
<p>It's also important to note that we do not allow third party behavioural tracking</p>
<p class="title">COPPA (Children Online Privacy Protection Act)</p>
<p>When it comes to the collection of personal information from children under 13, the Children's Online Privacy Protection Act (COPPA) puts parents in control. The Federal Trade Commission, the nation's consumer protection agency, enforces the COPPA Rule, which spells out what operators of websites and online services must do to protect children's privacy and safety online.</p>
<p>We do not specifically market to children under 13.</p>
<p class="title">Contacting Us</p>
<p>If there are any questions regarding this privacy policy you may contact us using the following email address: info@prizepigs.ie</p>
EOD;


$termsBody = <<<'EOD'
<p>These terms and conditions apply to all competitions featured online on the Prize Pigs website <a href="https://www.prizepigs.ie/">www.prizepigs.ie</a> and the Prize Pigs mobile applications.</p>
<p>The Promoter is Oink Digital trading as Prize Pigs(.ie) . 3rd Party suppliers are those companies and organisations providing the prizes and giveaways.</p>
<p>You are deemed to accept these terms and conditions when you enter a competition, together with any specific terms for such competition which may be mentioned in any messages or on our website/apps ("Competition Information").</p>
<p>If you do not agree with any of these terms and conditions then you should not enter the competition. If there is any inconsistency between these competition terms and conditions and any such Competition Information, the Competition Information shall prevail.</p>
<p>These terms and conditions may be amended or varied at any time without prior notice. Any changes will be posted on Prize Pigs website <a href="https://www.prizepigs.ie/">www.prizepigs.ie</a> It is your responsibility to ensure you review these terms and conditions regularly to familiarise yourself with any changes. We recommend that you print and store or save a copy of these terms and conditions for future reference.</p>

<p class="title">Entry</p>
<p>Entry is open to residents of Republic of Ireland (ROI) unless otherwise specified.</p>
<p>Certain competitions require that users must be over 18 to enter a competition.</p>
<p>Employees of Prize Pigs and any associated group companies, prize sponsor and/or agencies associated with our competitions and their immediate families are ineligible to enter. Any such entries will be invalid. For these purposes, immediate family includes partner, grandchild, child, brother, step-brother, sister, step-sister, parent, step-parent, or grandparent of you or your partner or anyone noted as next of kin on any legal document.</p>
<p>Prize Pigs reserves the right to require proof of age and evidence to verify the identity of an entrant at any time, and may use any reasonable channels and methods available to carry out checks of any details provided by entrants.<p>
<p>Registering with Prize Pigs constitutes permission to use the registrants name and email address for the purposes of advertising, promotion or publicity in any media without additional compensation or notification.</p>
<p>The opening and closing date and time for entries is as indicated in the Competition Information. Any entries received before or after these times will be disregarded.</p>
<p>Entry to the competition must be by the applicable method(s) and in accordance with the deadlines as indicated in the Competition Information.</p>
<p>Web entrants are required to follow the instructions on the Prize Pigs website/app as indicated in the Competition Information. Entrants will be required to register their details on the prizepigs.ie and to answer a question to the relevant competition. There is no charge for competition entries.</p>

<p class="title">Valid Entries</p>
<p>Any entries which are incomplete, incorrect, inaudible, incomprehensible, or not received by Prize Pigs by the due deadline will be void.</p>
<p>In the event of any fault, mistake, misunderstanding or dispute concerning the correctness or acceptability of any answers given by entrants, or the operation of any part of the competition, network or phone system, the decision of Prize Pigs shall be final and no correspondence will be entered into.</p>
<p>Prize Pigs will not be liable to reimburse expenses incurred in making an entry and no refund will be made for the cost of any entry.</p>
<p>Prize Pigs reserves the right to reject bulk entries.</p>
<p class="title">Prizes</p>
<p>Only one prize per person is permissible, except where otherwise stated in the Competition Information. </p>
<p>The prize is as specified in the Competition Information. The winner is solely responsible for all insurance, applicable taxes and for any costs, expenses and charges not included in the prize description in the Competition Information. The prize is also subject to any terms and conditions of the manufacturer or supplier.</p>
<p>Winners will be chosen at random from all valid entries using Prize Pig's custom build software program unless otherwise indicated in the Competition Information. Where the winner is randomly selected from all the correct and valid entries, the draw will take place on the closing date indicated in the Competition Information.</p>
<p>The winner will be notified on the date the winning entry is selected or as soon as practical thereafter, or as otherwise indicated in the Competition Information. You will be contacted at the email address provided when entering the competition. You will be asked to specifically confirm that you are a resident of ROI, that you are not related to any Prize Pigs employee or prize sponsor employee and that you are aged at least 18 years of age or otherwise if stated in the Competition Information, dependant on the competition. You will have a specified fixed time period in which to claim your prize, usually 7 days unless otherwise specified in the Competition Information. Failure to respond within the specified time period may result in forfeiture of the prize although Prize Pigs will make reasonable efforts to contact the winner to ensure this does not happen. However, Prize Pigs reserves the right to offer the prize to the next eligible entrant and thereafter until a winner is found.</p>
<p>Prize Pigs may refuse to provide a prize, or may seek its recovery, in the event of non-entitlement under these Terms or an entrant's breach of these Terms, or the Competition Information, or fraud or dishonesty.</p>
<p>Prize Pigs reserves the right in its sole discretion to withhold delivery of a prize until proof of eligibility and identity has been confirmed and to disqualify the entrant in the event this is not provided, within any period specified by Prize Pigs.</p>
<p>Prize Pigs endeavours to deliver the prize to the winner within twenty eight (28) days from the date of the claim, unless otherwise specified in the Competition Information. Delivery restrictions may apply to specific competitions.</p>
<p>No cash equivalent or alternative prize will be given and the prize is non-transferable and non-exchangeable. However, Prize Pigs reserves the right to change the prize due to circumstances beyond its control or to offer an alternative of similar value.</p>
<p>Prize Pigs is not obliged to supply a replacement prize won for any concerts/events/exhibitions which are cancelled by the promoter.</p>
<p>Where the prize includes a cheque, such cheque will be made payable to the name of the winning entry in euros. A cheque prize cannot be made payable to any third party. No other form of payment will be made.</p>
<p>Through entering this promotion all contestants agree to the terms of this promotion.</p>
<p>If sponsors have agreed to provide the prize and for whatever reason, are unable to deliver the prize, Prize Pigs have no obligation to provide a substitute or alternative prize. No cash alternative will be available.</p>

<p class="title">Liability</p>
<p>Nothing in these terms and conditions restricts your statutory rights as a consumer. For more details on your statutory rights you should contact your local Trading Standards Office or Citizen's Advice Bureau.</p>
<p>Prize Pigs cannot promise that the various processes involved in providing the competition will be free from errors or omissions nor that they will be available uninterrupted and in a fully operating condition at all times. These services may be suspended temporarily and without notice in the case of system failure, maintenance or repair or for reasons reasonably beyond the control of Prize Pigs. Prize Pigs will not be liable to you or to any other person in the event that all or any part of these services are discontinued, modified or changed in any way.</p>
<p class="title">Standars Terms</p>
<p>In the event that any entrant does not, or is unable to comply with these Terms and Conditions or the Competition Information, Prize Pigs shall be entitled at its sole discretion to disqualify such entrant, without any further liability to such entrant. Entrants must comply with any directions given to them by Prize Pigs including in relation to any and all relevant laws, rules and regulations.</p>
<p>These terms and conditions are available in English only and shall be exclusively governed by and construed in accordance with the laws of ROI. </p>
<p>Prize Pigs reserves the right to withdraw or amend any competition as necessary due to circumstances outside its reasonable control.</p>
<p class="title">Data Protection</p>
<p>Information and data which is provided by entrants when they enter ("personal data") will be held and used by Prize Pigs, and their suppliers and contractors in order to administer the competition. Entrants' personal data may also be passed to their mobile phone provider or to relevant regulatory bodies, the police or other authorities in the course of the investigation of any complaints or suspected unlawful activity or where requested by the phone provider in connection with the billing arrangements for the competition. Aggregate and non personal data may also be used for the purpose of undertaking market research or in facilitating reviews, developments and improvements to relevant services.</p>
<p>Any personal data will only otherwise be used in accordance with Prize Pigs privacy policy which can be viewed at <a href="https://www.prizepigs.ie/pages.php?page=privacy">https://www.prizepigs.ie/pages.php?page=privacy.</a> Prize Pigs will only use an entrant's data to send information of offers or services that may be of interest to that entrant from time to time or to pass that entrant's data to carefully selected third parties if that entrant has selected by opting-in to receive such information.</p>


EOD;

$aboutBody = <<<'EOD'
<p>Prize Pigs is Ireland's first dedicated mobile app and mobile optimised website for competitions and giveaways.</p> 
<p>Packed with fabulous prizes and exclusive giveaways, Prize Pigs offers you the chance to win fantastic prizes and whats more, it's completely free.</p>
<p>Simply register once and enter into as many competitions as you like.</p>
<p>Prize Pigs also run monthly draws for:</p>
<ul>
<li>Our new users who joined in the previous month.</li>
<li>Users who entered any competition the preceding month.</li> 
<li>Unlucky user's who have entered in competitions the last month but didn't win anything.</li>
<li>User who share, follow, like or mention us on social media platforms the previous month.</li>
<li>If that's not enough... We also run spot competitions when we're feeling even more generous than usual. So keep an eye on your inbox.</li>
</ul>
<h1>Download our app now: </h1>
<p class="about-app-icons">
<a href="https://itunes.apple.com/us/app/prize-pigs/id962190183?ls=1&mt=8" target="_blank">
<img src="https://s3-eu-west-1.amazonaws.com/prizepigs/img/ios.png" class="ios"/>
</a>
<a href="https://play.google.com/store/apps/details?id=io.cordova.prizepigs" target="_blank">
<img src="https://s3-eu-west-1.amazonaws.com/prizepigs/img/android.png" class="android"/>
</a>
</p> 
EOD;

$ways = array("title"=>"Ways to win",
              "content"=>$waysBody
              );
$terms = array("title"=>"Terms and conditions",
              "content"=>$termsBody
              );
$about = array("title"=>"About Prize Pigs",
              "content"=>$aboutBody
              );
$privacy = array("title"=>"Privacy Policy",
               "content"=>$privacyBody
               );
$contact = array("title"=>"Contact Us",
              "content"=>""
              );

$pages = array(
    "ways" => $ways,
    "terms" => $terms,
    "about" => $about,
    "privacy" => $privacy,
    "contact" => $contact
);

echo json_encode($pages);

?>