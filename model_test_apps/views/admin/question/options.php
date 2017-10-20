<div class="row">
    <div class="col-lg-12">
            <?php 
            foreach ($questions_details as $indx => $val) {
                if ($val['details'] !='') {
                    print_r($val['details']);
                    echo "<br/>";
                }
                if ($val['image'] !='') {
                    $picture = base_url().'uploads/question/questions/'.$val['image'];
                    $pic_path = $val['image_path']."".$val['image'];
                    if (file_exists($pic_path)) {
            ?>
                    <img src="<?php echo $picture; ?>" height="30" width="50" />
            <?php
                    }
                } 
                break;             
            }
            ?>         
    </div>
</div>
<div class="row"> &nbsp; </div>
<div class="row">
    <div class="col-lg-12">
        <?php        
        if (! empty($options)) {
        ?>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Options</th>                               
                    <th>Right Answer</th>  
                </tr>
            </thead>
            <tbody>
            <?php 
            $i=0;                
                foreach ($options as $key => $value) {$i++;
                ?>
                    <tr>
                        <td><?php print_r($i); ?></td>           
                        <td>
                        <?php 
                        if ($value['option_details'] !='') {
                            print_r($value['option_details']);
                            echo "<br/>";
                        }
                        ?> 
                        <?php 
                        if ($value['image'] !='') {
                            $picture = base_url().'uploads/question/options/'.$value['image'];
                            $pic_path = $value['image_path']."".$value['image'];
                            if (file_exists($pic_path)) {
                        ?>
                            <img src="<?php echo $picture; ?>" height="30" width="50" />
                        <?php
                            }
                        }

                        ?> 
                        </td>          
                        <td><?php if (isset($value['answer_option_id'])) {?> <i title="Delete" class="fa fa-check-square-o"></i> <?php } ?></td> 
                    </tr>
            <?php                
                }
            ?>
            </tbody>
        </table>
        <?php   
            }else{
                echo "No option found !";
            }
        ?>                            
	</div>
</div>