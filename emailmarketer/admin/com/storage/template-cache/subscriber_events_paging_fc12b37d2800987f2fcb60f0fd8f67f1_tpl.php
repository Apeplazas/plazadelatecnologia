<?php $IEM = $tpl->Get('IEM'); ?><div align="right">
	<?php print GetLang('ResultsPerPage'); ?>:&nbsp;
	<select name="PerPageDisplay" id="PerPageDisplay<?php if(isset($GLOBALS['TableType'])) print $GLOBALS['TableType']; ?>" style="margin-bottom: 4px; width: 55px" onChange="eventsTable('<?php if(isset($GLOBALS['SortColumn'])) print $GLOBALS['SortColumn']; ?>','<?php if(isset($GLOBALS['SortDirection'])) print $GLOBALS['SortDirection']; ?>',1,$('#PerPageDisplay').val());"><?php if(isset($GLOBALS['PerPageDisplayOptions'])) print $GLOBALS['PerPageDisplayOptions']; ?></select>&nbsp;&nbsp;&nbsp;&nbsp;
	<?php print GetLang('Pages'); ?>: <?php if(isset($GLOBALS['DisplayPage'])) print $GLOBALS['DisplayPage']; ?>
</div>