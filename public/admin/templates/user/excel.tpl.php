<?php 
header('Content-Type: text/html; charset=utf-8');
header('Content-type: application/ms-excel');
$now = date('Y-m-d-H-i-s');
header("Content-Disposition: attachment; filename=user_export_{$now}.xls");
?>
<table border="0" cellspacing="0" cellpadding="0" class="TbList" summary="使用者列表" id="RowList">    
    <thead>
        <tr>
            <th>Facebook ID</th>
            <th>玩家名稱</th>
            <th>Email</th>
            <th>性別</th>
            <th>關卡A</th>
            <th>關卡B</th>
            <th>關卡C</th>
            <th>關卡D</th>
            <th>關卡E</th>
            <th>關卡F</th>
        </tr>
    </thead>
    <tbody>
        <?php if($this->list):
                foreach($this->list as $key => $row):
        ?>
        <tr>
            <td><?php echo $row["fb_id"];?></td>
            <td><?php echo $row["user_name"];?></td>
            <td><?php echo $row["email"];?></td>
            <td><?php echo ($row["sex"] == "male") ? "男" : "女";?></td>
            <td><?php echo ($row["act1"] > 0) ? "完成" : "未完成"; ?></td>
            <td><?php echo ($row["act2"] > 0) ? "完成" : "未完成"; ?></td>
            <td><?php echo ($row["act3"] > 0) ? "完成" : "未完成"; ?></td>
            <td><?php echo ($row["act4"] > 0) ? "完成" : "未完成"; ?></td>
            <td><?php echo ($row["act5"] > 0) ? "完成" : "未完成"; ?></td>
            <td><?php echo ($row["act6"] > 0) ? "完成" : "未完成"; ?></td>  
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>