<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<form name="new_subject" method="post" action="index.php?content=makepost">
<table>
	<tr>
    	<td>Subject Title:</td>
        <td><input type="text" name="title" id="subject_title" /></td>
    </tr>
    <tr>
    	<td>Category:</td>
       	<td>
        	<select name="category" size="3" id="category">
        		<option id="technical_issues">technical issues</option>
                <option id="cartalk">cartalk</option>
                <option id="car_unrelated">car unrelated</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Write your message in the following textbox</td>
    <tr>
    	<td><input type="text" name="message" id="message" width="300" height="150" /></td>
    </tr>
</table>
</html>           