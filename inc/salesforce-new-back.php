<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: Please add the following <META> element to your page <HEAD>.      -->
<!--  If necessary, please modify the charset parameter to specify the        -->
<!--  character set of your HTML page.                                        -->
<!--  ----------------------------------------------------------------------  -->

<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">

<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: Please add the following <FORM> element to your page.             -->
<!--  ----------------------------------------------------------------------  -->

<form action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">

<input type=hidden name="oid" value="00D6A000001iTWP">
<input type=hidden name="retURL" value="http://hearttutoring.org/thank-you/">

<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: These fields are optional debugging elements. Please uncomment    -->
<!--  these lines if you wish to test in debug mode.                          -->
<!--  <input type="hidden" name="debug" value=1>                              -->
<!--  <input type="hidden" name="debugEmail"                                  -->
<!--  value="tayler.fisher@hearttutoring.org">                                -->
<!--  ----------------------------------------------------------------------  -->

<label for="first_name">First Name</label><br>
<input  id="first_name" maxlength="40" name="first_name" size="20" type="text" />
<br><br>

<label for="last_name">Last Name</label><br>
<input  id="last_name" maxlength="80" name="last_name" size="20" type="text" />
<br><br>

<label for="email">Email</label><br>
<input  id="email" maxlength="80" name="email" size="20" type="text" />
<br><br>

Alternate Email: (Optional)<br>
<input  id="00N2G00000CheFA" maxlength="80" name="00N2G00000CheFA" size="20" type="text" />
<br><br>

Phone number:<br>
<input  id="00N2G00000ChccW" maxlength="40" name="00N2G00000ChccW" onkeydown="formatPhoneOnEnter(this, event);" size="20" type="text" />
<br><br>

Time Commitment:<br>
<select  id="00N6A00000MTg6j" name="00N6A00000MTg6j" title="Time Commitment"><option value="">--None--</option><option value="1 hour (two sessions)">1 hour (two sessions)</option>
<option value="30 minutes (one session)">30 minutes (one session)</option>
<option value="30 minutes (two sessions)">30 minutes (two sessions)</option>
<option value="1 hour two times per week (four sessions)">1 hour two times per week (four sessions)</option>
<option value="Other">Other</option>
</select>
<br><br>

Time Commitment Other: (Optional)<br>
<input  id="00N6A00000MTsDX" maxlength="255" name="00N6A00000MTsDX" size="20" type="text" />
<br><br>

Setting Preference:<br>
<select  id="00N2G00000ChccM" name="00N2G00000ChccM" title="Setting Preference">
  <option value="">--None--</option>
  <option value="In-person only">In-person only</option>
<option value="Virtual only">Virtual only</option>
<!-- <option value="No preference">No preference</option> -->
<option value="Willing to tutor either in-person or virtual">Willing to tutor either in-person or virtual</option>
</select>
<br><br>

School Preference: (Optional)<br>
<input  id="00N6A00000MTsKY" maxlength="100" name="00N6A00000MTsKY" size="20" type="text" />
<br><br>

Other Preferences: (Optional)<br>
<textarea  id="00N6A00000MTxGr" name="00N6A00000MTxGr" rows="3" type="text" wrap="soft"></textarea>
<br><br>

How Did You Hear About Heart?: (Optional)<br>
<select  id="00N6A00000MTsDm" name="00N6A00000MTsDm" title="How Did You Hear About Heart?">
  <option value="">--None--</option>
  <option value="Returning Tutor">Returning Tutor</option>
<option value="Other">Other</option>
</select>
<br><br>

How Did You Hear About Heart Other:<br>
<textarea  id="00N6A00000Mk09D" name="00N6A00000Mk09D" rows="3" type="text" wrap="soft"></textarea>
<br><br>

Birthdate:<br>
<span class="dateInput dateOnlyInput"><input  id="00N2G00000ChRfC" name="00N2G00000ChRfC" size="12" type="text" /></span>
<br><br>

Internet Confirmation:<br>
<input  id="00N2G00000Cd9wC" name="00N2G00000Cd9wC" type="checkbox" value="1" /> I confirm that I have access to an electronic device with an internet connection, a functioning webcam, and the ability to access Google Jamboard for virtual tutoring.
<br><br>

<input type="submit" name="submit">

</form>
