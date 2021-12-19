#version:emlog 4.0.0
#date:14-12-2011 13:05
#tableprefix:emlog_
DROP TABLE IF EXISTS emlog_attachment;
CREATE TABLE `emlog_attachment` (
  `aid` smallint(5) unsigned NOT NULL auto_increment,
  `blogid` mediumint(8) unsigned NOT NULL default '0',
  `filename` varchar(255) NOT NULL default '',
  `filesize` int(10) NOT NULL default '0',
  `filepath` varchar(255) NOT NULL default '',
  `addtime` bigint(20) NOT NULL,
  PRIMARY KEY  (`aid`),
  KEY `blogid` (`blogid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS emlog_blog;
CREATE TABLE `emlog_blog` (
  `gid` mediumint(8) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `date` bigint(20) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` longtext NOT NULL,
  `alias` varchar(200) NOT NULL default '',
  `author` int(10) NOT NULL default '1',
  `sortid` tinyint(3) NOT NULL default '-1',
  `type` varchar(20) NOT NULL default 'blog',
  `views` mediumint(8) unsigned NOT NULL default '0',
  `comnum` mediumint(8) unsigned NOT NULL default '0',
  `tbcount` mediumint(8) unsigned NOT NULL default '0',
  `attnum` mediumint(8) unsigned NOT NULL default '0',
  `top` enum('n','y') NOT NULL default 'n',
  `hide` enum('n','y') NOT NULL default 'n',
  `allow_remark` enum('n','y') NOT NULL default 'y',
  `allow_tb` enum('n','y') NOT NULL default 'y',
  `password` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`gid`),
  KEY `date` (`date`),
  KEY `author` (`author`),
  KEY `sortid` (`sortid`),
  KEY `type` (`type`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO emlog_blog VALUES('2','Úi dzời ơi!!!','1321726520','<p><span style=\"color:#8b0000;font-size:x-small;\"><span style=\"line-height:19px;\"><b>Úi dzời ơi!!!</b></span></span></p>\r\n<p><span style=\"color:#8b0000;font-size:x-small;\"><span style=\"line-height:19px;\"><b><img src=\"http://3.bp.blogspot.com/-gpg_6al0to8/TcP9YalAmII/AAAAAAAAACM/CaG6xi9DeSg/s1600/22-cute-funny-danbo-cardboard-box-art-wanna-hug-body-language.jpg\" alt=\"\" border=\"0\" /><br />\r\n</b></span></span></p>','','','1','-1','blog','14','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('3','Vô tình gặp nhau ba lần là nhân duyên.','1321802873','<p><span style=\"font-family:\'Palatino Linotype\';\"><b><span style=\"color:#337fe5;\"><br />\r\n</span></b></span></p>\r\n<p><span style=\"font-family:\'Palatino Linotype\';\"><b><span style=\"color:#337fe5;\">Có những lần tình cờ gặp nhau đơn giản chỉ biết mặt nhau hay thậm chí chẳng để ý tới,</span></b></span></p>\r\n<span style=\"color:#337fe5;\"> </span><p><span style=\"font-family:\'Palatino Linotype\';\"><b><span style=\"color:#337fe5;\">nhưng nhờ có nó ta chợt nhận ra : vô tình gặp nhau ba lần đó là nhân duyên.</span></b></span></p>\r\n<p><span style=\"font-family:\'Palatino Linotype\';\"><b><span style=\"color:#337fe5;\"><br />\r\n</span></b></span></p>\r\n<p><span style=\"font-family:\'Palatino Linotype\';\"><b><span style=\"color:#337fe5;\"><img src=\"http://du-lich.chudu24.com/f/d/090807/ve-dep-huyen-ao-dat-viet3592.jpg\" alt=\"\" border=\"0\" /><br />\r\n</span></b></span></p>','','','2','-1','blog','5','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('4','I Miss You.','1321807779','<p><iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/Y52M9gVy-KU\" frameborder=\"0\" allowfullscreen=\"\"></iframe></p>\r\n<p>&nbsp;</p>\r\n<p>Tắt nhạc bên phải rồi nghe nha.</p>','','','2','-1','blog','3','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('5','Bủm ăn cứt.','1321878690','<p>Bủm ăn cứt gòa. ^^!</p>\r\n<p>Hì hì hì/ Hà Hà Hà!!!</p>','','','2','-1','blog','6','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('6','And Now When I Grow Up?','1321906063','<div style=\"font-size:14px;line-height:19px;\"><span style=\"color:#555555;font-family:\'arial, verdana, tahoma, sans-serif\';\"><b><div><span style=\"font-family:\'Palatino Linotype\';\">Nhớ lúc bé, rồi khi còn đi học, lúc nào cũng mong được chóng lớn, lớn để làm những việc mình thích, để thực hiện những ước mơ của mình, để mọi người tôn trọng ý kiến của mình, được tự chứng tỏ mình...</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">And Now When I Grow UP ?</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- 18 tuổi, tuổi chưa là người lớn hoàn toàn, nhưng cũng chẳng là trẻ con nữa.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Bước những bước chân đầu tiên vào đời, cái tuổi tự mình làm chủ cuộc sống, cũng có thể gọi một phần nào đó là “lớn”, đã biết tự sắp xếp, tự chịu trách nhiệm cuộc sống cho mình, mới thấy “lớn” không như những mong ước ngày bé.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- Người ta “lớn”,tự chịu trách nhiệm cuộc sống của mình...</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Rồi những thành công hay thất bại đều tự mình đón nhận.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Có những sự thất bại nặng nề làm con người hụt hẫng, suy sụp nhưng khi ta đã “lớn”, ta phải tự mình nhận về những nỗi buồn của riêng mình.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” là biết cảm nhận cuộc sống, biết buồn, biết đau khổ, biết tính toán cho mỗi ngày mới.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Biết buồn khi gặp thất bại, biết chia sẻ với những nỗi đau, phải giấu đi những suy nghĩ thật của mình để mong người khác vui lòng.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- Khi ta “lớn”, trong mỗi nụ cười dường như vẫn ẩn trong đó những lo toan, những nỗi buồn, những tính toán cho những ngày tới.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Hiếm khi “lớn” mà ta được cười thoải mái, vô tư như ngày còn bé.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Có những chuyện buồn, trắc trở trong cuộc sống, khi “lớn” ta phải giấu kín trong lòng, không thể chia sẻ với ai, không như ngày bé có thể vô tư chia sẻ với bố mẹ.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” là ta mất đi sự thoải mái trong tâm hồn, để từng ngày trôi qua, người ta có thêm nhiều điều để suy nghĩ, từ đó trưởng thành hơn mỗi ngày.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- Người ta đã “lớn” khi nhìn cuộc sống bằng con mắt thực tế hơn, không còn mơ mộng những ước mơ cao đẹp như ngày trước.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Khi “lớn” ta chỉ biết sống cho ngày hôm nay, cho những công việc của buổi sáng, buổi chiều, buổi tối, cho những việc của hôm nay, ngày mai, tuần này, tuần sau.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Đâu còn những giờ phút ngẩn ngơ bên sân trường mơ một tương lai thật đẹp, một tương lai mà chỉ có những ước mơ về một cuộc sống dễ dàng.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” để biết lo lắng nhiều hơn cho người thân, bạn bè.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” là phải biết cho nhiều hơn là nhận, cho đi những tình cảm yêu thương của mình đến người xung quanh, không còn vô tư nhận về những sự quan tâm của bố mẹ, bạn bè mà không nghĩ đến sự đáp trả.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” là khi người ta biết xấu hổ về những thất bại, biết tự hào với những thành công, biết cuộc sống còn những điều chưa tốt, biết tìm cho mình một cuộc sống thật tốt.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” để ta hiểu rằng không có một điều gì có thể dễ dàng như mình mong muốn, cuộc sống là những khó khăn, thử thách, muốn đạt được những điều mong muốn phải cố gắng rất nhiều, cuộc sống không là một món quà tặng mà nó là sự cố gắng hết mình để nhận lấy.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- Và khi đã “lớn”, ta mới hiểu rằng khi ta lớn lên hằng ngày là thời gian những người thân ở lại bên ta càng ngắn lại, nhận biết rằng cuộc đời là những sự ly tan, không có gì là mãi mãi.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- Khi ta “lớn” ta mới hiểu những niềm hạnh phúc của tuổi thơ quí giá biết nhường nào và biết tiếc nuối những gì đã qua.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” để ta cảm nhận rõ ràng nhất tình cảm mọi người dành cho mình, đó không chỉ có sự yêu thương mà còn có cả những sự ganh ghét, sự khinh thường, sự dối trá.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Tất cả như thử thách mà mỗi người phải vượt qua trên con đường của mình và đôi lúc ta tưởng chừng không vượt qua được để qua mỗi thử thách lại thấy mình lớn hơn và trưởng thành hơn.</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- “Lớn” là xa rời tuổi thơ, tự đứng lên bằng chính đôi chân của mình, từ đó thấy cuộc sống này không hề đơn giản mà trái lại còn nhiều những nỗi buồn, những sự thất bại và còn đó cả những nỗi đau.&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">18 tuổi, liệu như vậy đã lớn chưa?&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">\"Lớn\" để thấy mình :&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- mất đi nhiều điều tốt đẹp,</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- mất đi sự hồn nhiên,</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- lớn để thấy nhiều điều không đẹp của cuộc sống</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- thấy mình mệt mỏi trong từng ngày trôi qua,</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- lớn để cảm thấy mình quá bé nhỏ trong biển lớn cuộc đời mênh mông…&nbsp;</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">- Nhưng \"Lớn\" lên cũng để cảm thấy cuộc đời lắm sắc,nhiều màu, để được yêu thương ,để thấy cuộc đời cũng có nhiều điều thú vị…...</span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><br />\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span></div>\r\n<span style=\"font-family:\'Palatino Linotype\';\"> </span><div><span style=\"font-family:\'Palatino Linotype\';\">Ta đang dần lớn lên từng ngày,từng giờ,từng phút,từng giây....Và ta nên sống cho trọn vẹn từng ngày.</span></div>\r\n</b></span></div>','<b style=\"color:#555555;font-family:\'arial, verdana, tahoma, sans-serif\';font-size:14px;line-height:19px;\"><div><span style=\"font-family:\'Palatino Linotype\';\">Nhớ lúc bé, rồi khi còn đi học, lúc nào cũng mong được chóng lớn, lớn để làm những việc mình thích, để thực hiện những ước mơ của mình, để mọi người tôn trọng ý kiến của mình, được tự chứng tỏ mình...</span></div>\r\n</b>','','2','-1','blog','7','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('7','Nguyễn Du có thể bạn chưa biết.','1321935564','<p><b style=\"color:#999999;font-family:verdana, geneva, lucida, \'lucida grande\', arial, helvetica, sans-serif;font-size:13px;line-height:normal;text-align:left;\"><span style=\"color:Yellow;\"><span style=\"font-family:\'Palatino Linotype\';\"><span style=\"color:DarkGreen;\"><img src=\"http://images-vinabook.com/product/06/p5627/_fill_300_p5627.jpg\" alt=\"\" border=\"0\" /><br />\r\n</span></span></span></b></p>\r\n<p><b style=\"color:#999999;font-family:verdana, geneva, lucida, \'lucida grande\', arial, helvetica, sans-serif;font-size:13px;line-height:normal;text-align:left;\"><span style=\"color:Yellow;\"><span style=\"font-family:\'Palatino Linotype\';\"><span style=\"color:DarkGreen;\"><br />\r\n</span></span></span></b></p>\r\n<p style=\"text-align:left;\"><b style=\"color:#999999;font-family:verdana, geneva, lucida, \'lucida grande\', arial, helvetica, sans-serif;font-size:13px;\"><span style=\"color:Yellow;\"><span style=\"font-family:\'Palatino Linotype\';\"><span style=\"color:DarkGreen;\">Nguyễn Du là một nho sĩ người Ấn Độ,sinh năm 1765-1820,sinh trưởng trong một gia đình đại quý tộc.Cha ông là Quang Trung,mẹ là Dương Quý Phi.Năm 1818,ông được cử đi sứ sang Trung Quốc,ngay lập tức,ông lọt vào mắt xanh của nữ hoàng đế Võ Tắc Thiên.May mắn thay,ông an toàn trở về nước,tuy nhiên 2 năm sau,tức 1820,ông lại bị cử sang Trung Quốc,bị ép hôn,Nguyễn Du đã tự sát để bảo toàn khí tiết!&gt;\"&lt;<br />\r\n<br />\r\nPhiêu bạt nhiều nơi đã tạo cho Nguyễn Du một vốn sống phong phú,hiểu rõ nổi khổ của nhân dân,từ đó,ông đã viết nên Truyện Kiều,còn gọi là Đoạn Trường Thất Thanh.Tác phẩm đã được liệt vào hàng Tứ Đại Kì Thư của Trung Hoa!Nhân vật chính là Điêu Thuyền và cuộc đời gian nan,lận đận của nàng!Nói tóm lại!Nguyễn Du là một họa sĩ thiên tài và Truyện Kiều là một ca khúc tuyệt đỉnh!</span></span></span></b></p>','Nguyễn Du có thể bạn chưa biết.','','2','-1','blog','23','1','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('8','Trình chém gió của Vũ!','1322638427','<span style=\"font-family:arial, sans-serif;font-size:13px;\">Khi mình chém gió :</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Chó ngừng sủa.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Rùa đứng im.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Chim khen hay.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Giáo sư xoay kính nể.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Pê đê cúi đầu</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Gấu hoan hỉ.&nbsp;</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Khỉ vỗ tay.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Máy bay nổ.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Hổ thót tim.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Bim bim nát.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Cát mịt mù.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Mr Cù xin số&nbsp;</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Lã Bố chịu thua.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Cua toe càng.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Đại bàng té ngửa.</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Ngựa hét AAA...!!!</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Ôbama đòi làm đệ tử</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Liên hiệp Hội Phụ Nữ đòi tuyên dương</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Nhà thương quá tải</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">- Từ Hải pó tay ....&nbsp;</span><br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<br style=\"font-family:arial, sans-serif;font-size:13px;\" />\r\n<span style=\"font-family:arial, sans-serif;font-size:13px;\">=&gt; Nói chung là trình chém hay ko thể tả =)))))))))))</span>','','','2','-1','blog','36','3','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('9','Nhắn tin','1323145942','<br />\r\n<div id=\"post_message_671163\"><div id=\"lazyload\"><b><span style=\"font-family:&amp;quot;\">Người chồng khi biết vợ \r\ncó thai thì vô cùng vui mừng. Anh muốn cho tất cả mọi người biết tin này\r\n nên lấy điện thoại của vợ nhắn tin: \"Tôi đã có thai\" gửi đi cho tất cả \r\nmọi người trong danh bạ.</span><span style=\"font-family:&amp;quot;\"><br />\r\nĐược một lúc thấy mẹ vợ trả lời: \"Sao nói là chồng không sinh được, con lại quan hệ với thằng Tiểu Lí à\".<br />\r\n</span><span style=\"font-family:&amp;quot;\"><br />\r\nAnh rể trả lời: \"Cô tính xử lí thế nào?\".<br />\r\n<br />\r\nTiếp theo một người bạn thân nhắn tin: \"Chúng ta đã nửa năm không gặp nhau, cô đừng đổ lên đầu tôi\".<br />\r\n<br />\r\nĐồng nghiệp nhắn: \"Không phải chứ? Mới 2 ngày mà\".<br />\r\n<br />\r\nCấp trên trả lời: \"Tôi cho cô 10 triệu, cô nghỉ ngơi một thời gian đi\".<br />\r\n<br />\r\nKhách hàng nhắn tin: \"Được rồi, cô đừng hù dọa tôi, ngày mai cô tới nhà tôi, chúng ta sẽ kí hợp đồng\".<br />\r\n<br />\r\nMột người lạ nhắn: \"Cô li dị, chúng ta sẽ giữ đứa bé\".<br />\r\n<br />\r\nMột người lạ khác nhắn: \"Hôm đó còn có giám đốc, không phải cô tính nói là của tôi chứ?\".<br />\r\n<br />\r\nVà một người lạ khác nhắn: \"Đừng đùa chứ, tôi đã phẫu thuật triệt sản rồi\".<br />\r\n<br />\r\nChồng lăn ra bất tỉnh……@$%&amp;#$%^&amp;*@&amp;*%$^^</span></b></div>\r\n		</div>','','','2','-1','blog','2','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('10','Sống - Live','1323263363','<p><object width=\"560\" height=\"468\"><embed wmode=\"transparent\" src=\"http://www.youtube-nocookie.com/v/63CXDFpTl_s?fs=1&amp;border=1&amp;fs=1&amp;hl=en&amp;autoplay=1&amp;showinfo=0&amp;iv_load_policy=3&amp;showsearch=0?rel=0\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"560\" height=\"468\" /> </object>.</p>\r\n<p>Vì chúng ta sống.</p>','Vì sao chúng ta sống.','','2','-1','blog','2','0','0','0','n','n','y','y','');
INSERT INTO emlog_blog VALUES('11','Suy Nghĩ Trong Anh!','1323841913','<p style=\"text-align:left;\"><span style=\"font-family:\'\'lucida grande\', tahoma, verdana, arial, sans-serif\';\"><span style=\"font-size:11px;line-height:14px;\"><p style=\"text-align:center;\"><span style=\"font-size:12px;\">Cứ qua thêm 1 kỳ, mới biết thế nào là thi.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">1 kỳ trôi qua vội vã nhưng trong anh chẳng có gì.&nbsp;</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Những lo lắng trong anh, cứ lớn lên từng phút.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">cứ lớn theo từng giờ khi anh phải cắp sách đi thi.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Những suy nghĩ trong anh giờ đang chia làm 2.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Một nửa trong anh từng nghĩ anh sẽ“ qua như mọi lần”. Nhưng nếu lỡ 1 ngày, anh die 1, 2 môn.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">anh sẽ thế nào đây, anh sống thế nào đây...</span></p>\r\n<p style=\"text-align:center;\"></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Đừng để cho anh phải die,... phải thi lại 1 môn nữa.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Dù là tưởng tượng thôi nhưng anh cũng thấy ghê rồi.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">&nbsp;Đừng nói chi em ơi, vào thi không được nói.&nbsp;</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Chỉ cần chìa bài ra cho anh cũng được rồi...</span></p>\r\n<p style=\"text-align:center;\"></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Nhiều khi anh từng mơ, ngồi 1 mình cười ngẩn ngơ.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Chúng ta sẽ được thấy đề bài của ngày mai.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Có khó không em ơi, nếu giấc mơ này xa xôi, thì anh xin được giữ giấc mơ đó, ở trong suy nghĩ anh mà thồiiii</span></p>\r\n<p style=\"text-align:center;\"></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Nhiều khi anh từng mơ, ngồi 1 mình cười ngẩn ngơ.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Chúng ta sẽ được thấy đề bài của ngày mai.</span></p>\r\n<p style=\"text-align:center;\"><span style=\"font-size:12px;\">Có khó không em ơi, nếu giấc mơ này xa xôi, thì anh xin được giữ giấc mơ đó, ở trong suy nghĩ anh mà thồiiii</span></p>\r\n</span></span></p>\r\n<span class=\"text_exposed_show\" style=\"display:inline;text-align:left;\"><span style=\"font-family:\'\'lucida grande\', tahoma, verdana, arial, sans-serif\';\"> </span></span>','Suy Nghĩ Trong Anh!','','2','-1','blog','5','1','0','0','n','n','y','y','');

DROP TABLE IF EXISTS emlog_comment;
CREATE TABLE `emlog_comment` (
  `cid` mediumint(8) unsigned NOT NULL auto_increment,
  `gid` mediumint(8) unsigned NOT NULL default '0',
  `pid` mediumint(8) unsigned NOT NULL default '0',
  `date` bigint(20) NOT NULL,
  `poster` varchar(20) NOT NULL default '',
  `comment` text NOT NULL,
  `mail` varchar(60) NOT NULL default '',
  `url` varchar(75) NOT NULL default '',
  `ip` varchar(128) NOT NULL default '',
  `hide` enum('n','y') NOT NULL default 'n',
  PRIMARY KEY  (`cid`),
  KEY `gid` (`gid`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO emlog_comment VALUES('2','7','0','1322374944','dat','thằng nào bố láo thế nhỉ? chém gió vừa thôi, cản thận thành bão','chuvat@gmail.com','','118.68.3.141','n');
INSERT INTO emlog_comment VALUES('3','8','0','1322652633','Trọng Tiến','hay hay trình độ good nhưng chưa bằng anh kaka :D :))','trongtienitk33@gmail.com','','117.2.137.197','n');
INSERT INTO emlog_comment VALUES('4','8','0','1322660376','ku Bủm handsome','ghê quá! thêm mấy câu nữa nè\r\n- Từ Hải pó tay .... \r\n- ACB bỏ chạy...\r\n- Ăn mày xin chữ kí\r\n- Ku Bủm cười hí hí\r\n- Vũ khùng quá đi! kakaka','hihig9@gmail.com','','118.68.221.243','n');
INSERT INTO emlog_comment VALUES('5','8','4','1322712748','Trọng Tiến','@ku Bủm handsome: kaka hay quá haha chém gió','trongtienitk33@gmail.com','','117.2.131.113','n');
INSERT INTO emlog_comment VALUES('6','11','0','1323842292','Thành','Good job! Best song!!!','megadragon_thanh@yahoo.com','','123.22.30.78','n');

DROP TABLE IF EXISTS emlog_options;
CREATE TABLE `emlog_options` (
  `option_id` int(11) unsigned NOT NULL auto_increment,
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext NOT NULL,
  PRIMARY KEY  (`option_id`),
  KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

INSERT INTO emlog_options VALUES('1','blogname','TienVu.TV');
INSERT INTO emlog_options VALUES('2','bloginfo','I want to do what I want....whatever I like...Time waits for noone......');
INSERT INTO emlog_options VALUES('3','site_key','Đinh Tiến Vũ, Tiến Vũ, Vũ, Dinh Tien Vu, Tien Vu,Vu,dinhtienvu, tienvu,vu,daikavu,daika, vu dai ka,vuit, vu dai hoc, da lat, da lat university');
INSERT INTO emlog_options VALUES('4','blogurl','http://tienvu.tv/');
INSERT INTO emlog_options VALUES('5','icp','');
INSERT INTO emlog_options VALUES('6','admin_perpage_num','15');
INSERT INTO emlog_options VALUES('7','rss_output_num','10');
INSERT INTO emlog_options VALUES('8','rss_output_fulltext','n');
INSERT INTO emlog_options VALUES('9','index_lognum','5');
INSERT INTO emlog_options VALUES('10','index_comnum','10');
INSERT INTO emlog_options VALUES('11','index_twnum','10');
INSERT INTO emlog_options VALUES('12','index_newtwnum','5');
INSERT INTO emlog_options VALUES('13','index_newlognum','5');
INSERT INTO emlog_options VALUES('14','index_randlognum','5');
INSERT INTO emlog_options VALUES('15','comment_subnum','25');
INSERT INTO emlog_options VALUES('16','nonce_templet','V-Share Piol');
INSERT INTO emlog_options VALUES('17','admin_style','violet');
INSERT INTO emlog_options VALUES('18','tpl_sidenum','1');
INSERT INTO emlog_options VALUES('19','comment_code','n');
INSERT INTO emlog_options VALUES('20','isgravatar','y');
INSERT INTO emlog_options VALUES('21','login_code','n');
INSERT INTO emlog_options VALUES('22','reply_code','n');
INSERT INTO emlog_options VALUES('23','ischkcomment','n');
INSERT INTO emlog_options VALUES('24','ischkreply','n');
INSERT INTO emlog_options VALUES('25','isurlrewrite','0');
INSERT INTO emlog_options VALUES('26','isalias','n');
INSERT INTO emlog_options VALUES('27','isalias_html','n');
INSERT INTO emlog_options VALUES('28','isgzipenable','y');
INSERT INTO emlog_options VALUES('29','istrackback','y');
INSERT INTO emlog_options VALUES('30','isxmlrpcenable','y');
INSERT INTO emlog_options VALUES('31','istwitter','y');
INSERT INTO emlog_options VALUES('32','twnavi','Twitter');
INSERT INTO emlog_options VALUES('33','topimg','content/templates/default/images/top/terrace.jpg');
INSERT INTO emlog_options VALUES('34','custom_topimgs','a:0:{}');
INSERT INTO emlog_options VALUES('35','timezone','7');
INSERT INTO emlog_options VALUES('36','active_plugins','a:2:{i:0;s:13:\"tips/tips.php\";i:1;s:29:\"kl_highslide/kl_highslide.php\";}');
INSERT INTO emlog_options VALUES('37','navibar','a:1:{s:8:\"kl_album\";a:4:{s:5:\"title\";s:6:\"相册\";s:3:\"url\";s:33:\"http://tienvu.tv/?plugin=kl_album\";s:8:\"is_blank\";s:7:\"_parent\";s:4:\"hide\";s:1:\"y\";}}');
INSERT INTO emlog_options VALUES('38','widget_title','a:12:{s:7:\"blogger\";s:10:\"Thông tin\";s:8:\"calendar\";s:6:\"Lịch\";s:7:\"twitter\";s:7:\"Twitter\";s:3:\"tag\";s:3:\"Tag\";s:4:\"sort\";s:12:\"Phân loại\";s:7:\"archive\";s:10:\"Lưu trữ\";s:7:\"newcomm\";s:17:\"Nhận xét mới\";s:6:\"newlog\";s:10:\"Bài mới\";s:10:\"random_log\";s:18:\"Bài ngẫu nhiên\";s:4:\"link\";s:11:\"Liên kết\";s:6:\"search\";s:11:\"Tìm kiếm\";s:11:\"custom_text\";s:38:\"Tự đặt (Nhạc mà mình thích.)\";}');
INSERT INTO emlog_options VALUES('39','custom_widget','a:2:{s:11:\"custom_wg_1\";a:2:{s:5:\"title\";s:24:\"Nhạc mà mình thích.\";s:7:\"content\";s:722:\"<img style=\"visibility:hidden;width:0px;height:0px;\" border=0 width=0 height=0 src=\"http://c.gigcount.com/wildfire/IMP/CXNID=2000002.0NXC/bT*xJmx*PTEzMjE3ODI*OTQ*NDkmcHQ9MTMyMTc4MjUwNDUwNSZwPTE4MDMxJmQ9Jmc9MSZvPWU*NTk4NDIxYmRhZTRiNjM5YzVk/NDEyMDcxNDZjNjkz.gif\" /><embed src=\"http://assets.mixpod.com/swf/mp3/mff-touch.swf?myid=86825918&path=2011/11/20\" quality=\"high\" wmode=\"transparent\" flashvars=\"mycolor=222222&mycolor2=77ADD1&mycolor3=FFFFFF&autoplay=false&rand=0&f=4&vol=100&pat=14&grad=false\" width=\"235\" height=\"390\" name=\"myflashfetish\" salign=\"TL\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" border=\"0\" style=\"visibility:visible;width:235px;height:390px;\" /><br>\";}s:11:\"custom_wg_2\";a:2:{s:5:\"title\";s:4:\"HiHi\";s:7:\"content\";s:201:\"<script type=\"text/javascript\" src=\"http://www.blogdeco.jp/kuro/m/kuro.js\"></script><noscript><a href=\"http://www.blogdeco.jp/\" target=\"_blank\" title=\"ブログパーツ\">www.blogdeco.jp</a></noscript>\";}}');
INSERT INTO emlog_options VALUES('40','widgets1','a:4:{i:0;s:11:\"custom_wg_1\";i:1;s:8:\"calendar\";i:2;s:6:\"search\";i:3;s:11:\"custom_wg_2\";}');
INSERT INTO emlog_options VALUES('41','widgets2','');
INSERT INTO emlog_options VALUES('42','widgets3','');
INSERT INTO emlog_options VALUES('43','widgets4','');
INSERT INTO emlog_options VALUES('44','kl_album_info','a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Vũ Đại Ka\";s:11:\"description\";s:10:\"2011-11-20\";s:8:\"restrict\";s:7:\"protect\";s:7:\"addtime\";i:1321781901;s:3:\"pwd\";s:1:\"1\";}}');

DROP TABLE IF EXISTS emlog_reply;
CREATE TABLE `emlog_reply` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `tid` mediumint(8) unsigned NOT NULL default '0',
  `date` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL default '',
  `content` text NOT NULL,
  `hide` enum('n','y') NOT NULL default 'n',
  `ip` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `gid` (`tid`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS emlog_sort;
CREATE TABLE `emlog_sort` (
  `sid` tinyint(3) unsigned NOT NULL auto_increment,
  `sortname` varchar(255) NOT NULL default '',
  `alias` varchar(200) NOT NULL default '',
  `taxis` smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO emlog_sort VALUES('1','vu','vu','1');

DROP TABLE IF EXISTS emlog_link;
CREATE TABLE `emlog_link` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `sitename` varchar(30) NOT NULL default '',
  `siteurl` varchar(75) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `taxis` smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS emlog_tag;
CREATE TABLE `emlog_tag` (
  `tid` mediumint(8) unsigned NOT NULL auto_increment,
  `tagname` varchar(60) NOT NULL default '',
  `gid` text NOT NULL,
  PRIMARY KEY  (`tid`),
  KEY `tagname` (`tagname`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO emlog_tag VALUES('8','Úi',',2,');
INSERT INTO emlog_tag VALUES('9',' dzời',',2,');
INSERT INTO emlog_tag VALUES('10',' ơi',',2,');

DROP TABLE IF EXISTS emlog_trackback;
CREATE TABLE `emlog_trackback` (
  `tbid` mediumint(8) unsigned NOT NULL auto_increment,
  `gid` mediumint(8) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `date` bigint(20) NOT NULL,
  `excerpt` text NOT NULL,
  `url` varchar(255) NOT NULL default '',
  `blog_name` varchar(255) NOT NULL default '',
  `ip` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`tbid`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS emlog_twitter;
CREATE TABLE `emlog_twitter` (
  `id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `author` int(10) NOT NULL default '1',
  `date` bigint(20) NOT NULL,
  `replynum` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `author` (`author`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO emlog_twitter VALUES('1','I want to do what I want....whatever I like...Time waits for noone......','2','1321776889','0');

DROP TABLE IF EXISTS emlog_user;
CREATE TABLE `emlog_user` (
  `uid` tinyint(3) unsigned NOT NULL auto_increment,
  `username` varchar(32) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `nickname` varchar(20) NOT NULL default '',
  `role` varchar(60) NOT NULL default '',
  `photo` varchar(255) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO emlog_user VALUES('1','naphan','$P$BG3bIVvjlPpIQyeZUqvQ9JlshhL/ky0','','admin','','','');
INSERT INTO emlog_user VALUES('2','tienvu','$P$BnI42rPAkiD73xwZX5.sEsu3Q1SLKO.','Đinh Tiến Vũ','admin','','tienvuitdlu@gmail.com','He he he!');


#the end of backup