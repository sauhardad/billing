<td>
    <label for="edit_group_dropdown">Group</label>
</td>
<td colspan="3"  aria-invalid="true">
    <?php echo form_dropdown('edit_group_dropdown',array("0"=>"Select Group") + convert_to_keyvalue($groups),"0",'class="form-control" id="edit_group_dropdown"'); ?>
</td>
