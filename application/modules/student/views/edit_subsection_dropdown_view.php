<td>
    <label for="edit_subsection_dropdown">Subsection</label>
</td>
<td colspan="3"  aria-invalid="true">
    <?php echo form_dropdown('edit_subsection_dropdown',array("0"=>"Select Subsection") + convert_to_keyvalue($subsections),"0",'class="form-control" id="edit_subsection_dropdown" url-target="student/load_group" target-type="edit" target="tr_edit_group_dropdown" onchange="return loadDropdown(this);"'); ?>
</td>
