<?php 
header('Content-Type: text/html; charset=utf-8');
header('Content-type: application/ms-excel');
$now = date('Y-m-d-H-i-s');
header("Content-Disposition: attachment; filename=log_export_{$now}.xls");
?>
<table border="0" cellspacing="0" cellpadding="0" class="TbList" summary="LOG列表" id="RowList">    
    <thead>
        <tr>
            <th>日期</th>
            <th>開啟活動首頁人次</th>
            <th>遊戲介紹頁(點擊)</th>
            <th>活動辦法頁(點擊)</th>
            <th>得獎名單頁(點擊)</th>
            <th>尋寶去(點擊)</th>
            <th>粉絲團按讚人數</th>
            <th>新進入本活動人數</th>
            <th>透過本活動加入遊戲人數</th>
            <th>活動中，關卡 I 活動人數</th>
            <th>活動中，關卡 II 活動人數</th>
            <th>活動中，關卡 III 活動人數</th>
            <th>活動中，關卡 IV 活動人數</th>
            <th>活動中，關卡 V 活動人數</th>
            <th>活動中，關卡 VI 活動人數</th>
            <th>活動中，關卡 I 完成人數</th>
            <th>活動中，關卡 II 完成人數</th>
            <th>活動中，關卡 III 完成人數</th>
            <th>活動中，關卡 IV 完成人數</th>
            <th>活動中，關卡 V 完成人數</th>
            <th>活動中，關卡 VI 完成人數</th>
            <th>邀請好友活動人數</th>
            <th>邀請的好友進入活動人數</th>
            <th>分享至塗鴉牆數</th>
            <th>參加抽獎人數</th>
            <th>至遊戲官網造訪人次</th>
            <th>至遊樂迷造訪人次</th>
            <th>前往活動頁(點擊)</th>
            <th>前往官網(點擊)</th>
            <th>海商紀元點擊</th>
        </tr>
    </thead>
    <tbody>
    <?php if($this->list):
    foreach($this->list as $key => $row):
    ?>
        <tr>
            <td><?php echo $row['log_date'];?></td>
            <td><?php echo $row['index_click'];?></td>
            <td><?php echo $row['intro_click'];?></td>
            <td><?php echo $row['active_click'];?></td>
            <td><?php echo $row['award_click'];?></td>
            <td><?php echo $row['start_game'];?></td>
            <td><?php echo $row['count_like'];?></td>
            <td><?php echo $row['count_user'];?></td>
            <td><?php echo $row['count_already_join'];?></td>
            <td><?php echo $row['count_act_start_a'];?></td>
            <td><?php echo $row['count_act_start_b'];?></td>
            <td><?php echo $row['count_act_start_c'];?></td>
            <td><?php echo $row['count_act_start_d'];?></td>
            <td><?php echo $row['count_act_start_e'];?></td>
            <td><?php echo $row['count_act_start_f'];?></td>
            <td><?php echo $row['count_act_finish_a'];?></td>
            <td><?php echo $row['count_act_finish_b'];?></td>
            <td><?php echo $row['count_act_finish_c'];?></td>
            <td><?php echo $row['count_act_finish_d'];?></td>
            <td><?php echo $row['count_act_finish_e'];?></td>
            <td><?php echo $row['count_act_finish_f'];?></td>
            <td><?php echo $row['count_invite_friend'];?></td>
            <td><?php echo $row['count_invite_friend_enter'];?></td>
            <td><?php echo $row['facebook_share'];?></td>
            <td><?php echo $row['count_lottery'];?></td>
            <td><?php echo $row['official_click'];?></td>
            <td><?php echo $row['molome_click'];?></td>
            <td><?php echo $row['invite_active_click'];?></td>
            <td><?php echo $row['invite_official_click'];?></td>
            <td><?php echo $row['login_click'];?></td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>