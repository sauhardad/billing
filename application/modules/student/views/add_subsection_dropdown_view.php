<td>
    <label for="add_subsection_dropdown">Subsection</label>
</td>
<td colspan="3"  aria-invalid="true">
    <?php echo form_dropdown('add_subsection_dropdown',array("0"=>"Select Subsection") + convert_to_keyvalue($subsections),"0",'class="form-control" id="add_subsection_dropdown" url-target="student/load_group" target="tr_add_group_dropdown" target-type="add" onchange="return loadDropdown(this);"'); ?>
</td>
