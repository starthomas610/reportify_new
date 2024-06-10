<?php
$idrsl = $tablequery2->getColumnVal("rsl_id");
$material_id = $tablequery2->getColumnVal("material_id");
$component_id = $companalysis->getColumnVal("idcomponent");
$analysis_id = $tablequery2->getColumnVal("analysis_id"); ?>
<?php
$requirementslist = new WA_MySQLi_RS("requirementslist", $repnew, 0);
$requirementslist->setQuery("SELECT * FROM requirement WHERE requirement.material_id='$material_id'  AND requirement.rsl_id='$idrsl' AND requirement.analysis_id='$analysis_id' AND requirement.component_id='$component_id'");
$requirementslist->execute();
?>
<?php $idrequirements = $requirementslist->getColumnVal("idrequirements");
if (empty($idrequirements)) {

?>
  <?php
  $umlist = new WA_MySQLi_RS("umlist", $repnew, 0);
  $umlist->setQuery("SELECT * FROM unit_measure ORDER BY unit_measure.name");
  $umlist->execute();
  ?>
  <!-- insert requirements form -->

  <form method="post" id="insup">
    <tr class="child-row<?php echo $idanalysis; ?>" style="display: table-row;">
      <td><i class="fas fa-chevron-circle-right"></i> <?php echo ($companalysis->getColumnVal("name_component")); ?></td>
      <td><?php echo ($companalysis->getColumnVal("cas_component")); ?></td>
      <td><input name="minlim" type="text" class="form-control form-control-sm" id="minlim" size="15"></td>
      <td> <input name="maxlim" type="text" class="form-control form-control-sm" id="maxlim" size="15"></td>
      <td> <input name="loq" type="text" class="form-control form-control-sm" id="loq" size="15"></td>
      <td> <select class="form-select" name="um" id="um">
          <option value="">Select</option>
          <?php
          while (!$umlist->atEnd()) { //dyn select
          ?>
            <option value="<?php echo ($umlist->getColumnVal("id")); ?>"><?php echo ($umlist->getColumnVal("name")); ?></option>
          <?php
            $umlist->moveNext();
          } //dyn select
          $umlist->moveFirst();
          ?>
        </select>
      </td>
      <td> <input name="status" type="text" class="form-control form-control-sm" id="status" size="8"></td>


      <input name="idrequirements" type="hidden" id="idrequirements" value="<?php echo ($requirementslist->getColumnVal("idrequirements")); ?>">
      <input name="rsl_id" type="hidden" id="rsl_id" value="<?php echo ($tablequery2->getColumnVal("rsl_id")); ?>">
      <input name="analysis_id" type="hidden" id="analysis_id" value="<?php echo ($tablequery2->getColumnVal("analysis_id")); ?>">
      <input name="component_id" type="hidden" id="component_id" value="<?php echo ($companalysis->getColumnVal("idcomponent")); ?>">
      <input name="material_id" type="hidden" id="material_id" value="<?php echo ($tablequery2->getColumnVal("material_id")); ?>">
      <input name="insformname" type="hidden" id="formname" value="insertreq">

    </tr>
  </form>
<?php }
if (!empty($idrequirements)) {

?>
  <!-- update requirements form -->

  <form method="post" id="updatereq">
    <tr class="child-row<?php echo $idanalysis; ?>" style="display: table-row;">
      <td><i class="fas fa-chevron-circle-right"></i> <?php echo ($companalysis->getColumnVal("name_component")); ?></td>
      <td><?php echo ($companalysis->getColumnVal("cas_component")); ?></td>
      <td> <input name="minlim" type="text" class="form-control form-control-sm" id="minlim" value="<?php echo ($requirementslist->getColumnVal("lowerlimit_requirements")); ?>" size="10"></td>
      <td> <input name="maxlim" type="text" class="form-control form-control-sm" id="maxlim" value="<?php echo ($requirementslist->getColumnVal("upper_limit_requirements")); ?>" size="10"></td>
      <td> <input name="loq" type="text" class="form-control form-control-sm" id="loq" value="<?php echo ($requirementslist->getColumnVal("loq_requirements")); ?>" size="10"></td>
      <td> <select class="form-select" name="um" id="um">
          <option value="" <?php if (!(strcmp("", ($requirementslist->getColumnVal("unit_measure_id"))))) {
                              echo "selected=\"selected\"";
                            } ?>>Select</option>
          <?php
          while (!$umlist->atEnd()) { //dyn select
          ?>
            <option value="<?php echo ($umlist->getColumnVal("id")); ?>" <?php if (!(strcmp($umlist->getColumnVal("id"), ($requirementslist->getColumnVal("unit_measure_id"))))) {
                                                                            echo "selected=\"selected\"";
                                                                          } ?>><?php echo ($umlist->getColumnVal("name")); ?></option>
          <?php
            $umlist->moveNext();
          } //dyn select
          $umlist->moveFirst();
          ?>
        </select></td>
      <td> <input name="status" type="text" class="form-control form-control-sm" id="status" size="8"></td>

      <input name="idrequirements" type="hidden" id="rsl_id" value="<?php echo ($requirementslist->getColumnVal("idrequirements")); ?>">
      <input name="rsl_id" type="hidden" id="rsl_id" value="<?php echo ($tablequery2->getColumnVal("rsl_id")); ?>">
      <input name="analysis_id" type="hidden" id="analysis_id" value="<?php echo ($tablequery2->getColumnVal("analysis_id")); ?>">
      <input name="component_id" type="hidden" id="component_id" value="<?php echo ($companalysis->getColumnVal("idcomponent")); ?>">
      <input name="material_id" type="hidden" id="material_id" value="<?php echo ($tablequery2->getColumnVal("material_id")); ?>">
      <input name="upformname" type="hidden" id="formname" value="updatereq">
      <td> <button type="submit" class="btn btn-primary">Go</button></td>
    </tr>
  </form>
<?php } ?>