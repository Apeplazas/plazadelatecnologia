<?php $IEM = $tpl->Get('IEM'); ?><dt>
	<?php echo $tpl->Get('question_number'); ?>. <?php echo $tpl->Get('question'); ?>
	<p><?php echo $tpl->Get('question','description'); ?></p>
</dt>	
<dd>
	<table class="survey_results">
		<tbody>
			<tr><th colspan="2"></th><th class="survey_stats">Percent</th><th class="survey_stats">Responses</th></tr>
		<?php $array = $tpl->Get('stats'); if(is_array($array) || is_object($array)): foreach($array as $answer=>$stat): $tpl->Assign('answer', $answer, false); $tpl->Assign('stat', $stat, false);  ?>
			<?php if($tpl->Get('maxstats') == $tpl->Get('stat') && $tpl->Get('maxstats') != 0): ?>
				<tr class="winner">
				<td width="15%" align="right"><?php echo $tpl->Get('answer'); ?></td>
				<td width="300"><div class="bar"><div class="survey_percentage" style="width: <?php echo $tpl->Get('percentage',$tpl->Get("answer")); ?>%;"></div></div></td>
				<td class="winner"><?php echo $tpl->Get('percentage',$tpl->Get("answer")); ?>%</td><td class="winner"><?php echo $tpl->Get('stat'); ?></td>
			
			<?php else: ?>
				<tr>
				<td width="15%" align="right"><?php echo $tpl->Get('answer'); ?></td>
				<td width="300"><div class="bar"><div class="survey_percentage" style="width: <?php echo $tpl->Get('percentage',$tpl->Get("answer")); ?>%;"></div></div></td>
				<td class="survey_stats"><?php echo $tpl->Get('percentage',$tpl->Get("answer")); ?>%</td><td class="survey_stats"><?php echo $tpl->Get('stat'); ?></td>
			<?php endif; ?>	
			</tr>
		 <?php endforeach; endif; ?>
		</tbody>	
		<?php if($tpl->Get('total_others') > 0 ): ?>	
			<?php if($tpl->Get('maxstats') == $tpl->Get('total_others') && $tpl->Get('maxstats') != 0): ?>
				<tr class="winner">				
			<?php else: ?>
				<tr>
			<?php endif; ?>
					<td align="right"><a class="others_hide" id="more_<?php echo $tpl->Get('question_id'); ?>">Hide Answers</a> (<?php echo $tpl->Get('other_label'); ?>)</td><td width="300"><div class="bar"><div class="survey_percentage" style="width: <?php echo $tpl->Get('percentage','others'); ?>%;"></div></div></td>
					<td class="survey_stats"><?php echo $tpl->Get('percentage','others'); ?>%</td><td class="survey_stats"><?php echo $tpl->Get('total_others'); ?></td>
				</tr>
			<tbody id="othersmore_<?php echo $tpl->Get('question_id'); ?>">
				<?php $array = $tpl->Get('other_answers'); if(is_array($array) || is_object($array)): foreach($array as $index=>$other_answer): $tpl->Assign('index', $index, false); $tpl->Assign('other_answer', $other_answer, false);  ?>
					<tr>
						<td></td><td width="300"><?php echo $tpl->Get('index'); ?>. <?php echo $tpl->Get('other_answer','value'); ?></td><td class="browse"><a href="index.php?Page=Addons&Addon=surveys&Action=viewresponses&surveyId=<?php echo $tpl->Get('surveyId'); ?>&responseId=<?php echo $tpl->Get('other_answer','id'); ?>">Browse...</a></td><td></td>
					</tr>
				 <?php endforeach; endif; ?>
					<tr>
						<td></td><td align="right"> Previous  
						| 
						<?php if($tpl->Get('totalresponse') <= 10 ): ?>
								Next
						<?php else: ?>
							<a href="#" onclick="showResponsesAnswer(10,<?php echo $tpl->Get('question_id'); ?>,<?php echo $tpl->Get('surveyId'); ?>,<?php echo $tpl->Get('total_others'); ?>); return false;"> Next >></a>&nbsp;&nbsp;</td><td></td>
						<?php endif; ?>
					</tr>
			</tbody>
		<?php endif; ?>
	</table>
</dd>