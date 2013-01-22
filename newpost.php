<form name="new_subject" method="post" action="index.php?content=makepost">
<table>
	<tr>
    	<td class="left">Subject Title:</td>
        <td><input type="text" name="title" id="subject_title" /></td>
    </tr>
    <tr>
    	<td class="left">Category:</td>
       	<td>
        	<select name="category" size="3" id="category">
        		<option id="technical_issues">technical issues</option>
                <option id="cartalk">cartalk</option>
                <option id="car_unrelated">car unrelated</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
			Write your message in the following textbox<br />
			<textarea name="post" rows="4" cols="50">Write message here...</textarea>
		</td>
    </tr>
</table>