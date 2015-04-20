<td>
    <label for="add_group_dropdown">Group</label>
</td>
<td colspan="3"  aria-invalid="true">
    <?php echo form_dropdown('add_group_dropdown',array("0"=>"Select Group") + convert_to_keyvalue($groups),"0",'class="form-control" id="add_group_dropdown"'); ?>
</td>
