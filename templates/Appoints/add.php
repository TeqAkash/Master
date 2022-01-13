<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appoint $appoint
 * @var \Cake\Collection\CollectionInterface|string[] $patients
 * @var \Cake\Collection\CollectionInterface|string[] $doctors
 */
use Cake\Routing\Router;    
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
           
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="one_half form content">
            <?= $this->Form->create($appoint) ?>
            <fieldset>
                <legend><?= __('Add Appoint') ?></legend>
                <?php
                     echo $this->Form->control('department_id', [
                            'url' => ["controller"=>"Appoints","action"=>"add"],
                            'options' => $departments,    
                            'empty' => 'Pls Select Your Department',
                            'id' => 'department'

                        ]);
                    echo $this->Form->control('doctor_id',['id'=>'doctors','empty'=>'Pls Select Doctor']);
                    echo $this->Form->control('appoint_date');
                    // echo $this->Form->label('payment');
                    // echo $this->Form->radio('payment',['Pending','Completed']);
                    // echo $this->Form->label('status');
                    // echo $this->Form->radio('status',['Pending','Completed']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function(){
  $('#department').on('change', function() {
    var id = $(this).val();
    var targeturl = '<?= Router::url(["controller"=>"Doctors","action"=>"getDoctors"]); ?>';
    {
      $("#divLoading").addClass('show');
        $('#doctors').html('<option value="-1">Select Doctor </option>');   
          $.ajax({
              type:'get',
              url: targeturl+'/'+id,                  
              // data:'id='+id,
              dataType: 'json',
              success:function(result){
               
                  $("#divLoading").addClass('show');
                  value = result["result"][0]["id"];
                  key = result["result"][0]['name'];
                  $('#doctors').append("<option value='" + value + "'>" + key + "</option>");
              }
          });   
      
    };
});
});
</script>

