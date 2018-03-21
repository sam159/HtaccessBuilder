<div id="design">
  <h2>Create</h2>
  <div id="add-rule">
    <form action="" method="POST" id="form-add-rule">
      <select id="field-rule-select" name="rule-select">
        <option value="">-- Add New --</option>
        <?php
        foreach(HtRule_List::ListRules() as $class => $name)
        {
          ?>
        <option value="<?php echo $class;?>"><?php echo $name;?></option>
        <?php
        }
        ?>
      </select>
    </form>
  </div>
  <div style="clear:both;"></div>
  <div id="rule-edit">
  </div>
</div>
<div id="preview">
  <h2>Preview</h2>
  <div class="actions">
    <a href="javascript:rules.showListing()" class="first">Listing</a><a href="save.php" class="middle" id="save">Save</a><a href="download.php" id="save-as" class="middle">Download</a><a href="index.php?delete" id="delete" class="last">Delete</a>
  </div>
  <div id="listing-code" style="display:none;">
    <input type="button" class="button" onclick="javascript:rules.hideListing()" value="Close" id="listing-code-close"/>
    <textarea readonly wrap="off">
    </textarea>
  </div>
  <div id="preview-code">
  </div>
</div>