<div id="exam_activity_log">
    <table border="0" style="margin-top:10px;">
        <thead>
        <tr>
            <th>Exam Subject/Course</th>
            <th>Exam type</th>
            <th>Assign by</th>
            <th>Time and date to assign</th>
            <th>Question amount</th>
            <th>Exam status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($exam_lists)){
            ?>
            {exam_lists}
            <tr class="{stripe_class}">
                <td>{exam_name}</td>
                <td>{final_exam_type}</td>
                <td>{assigned_by}</td>
                <td>{final_date}</td>
                <td>{no_of_question}</td>
                <td>{final_status}</td>
            </tr>
            {/exam_lists}
        <?php
        }else{
            ?>
            <tr>
                <td colspan="6"> No exam found</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>