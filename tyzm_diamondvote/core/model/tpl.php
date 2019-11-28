<?php

if (!defined('IN_IA'))
	{
		
		exit('Access Denied');
		
	}

class Tyzm_Tpl
	{
		public function __construct()
			{
				global $_W;
			}
		
		public function style($filename, $tmp = "")
			{
				if (empty($tmp))
					{
						return $filename;
					}
				else
					{
						$source = TYZM_MODEL . "/template/mobile/" . $tmp . "/" . $filename . ".html";
						if (!is_file($source))
							{
								return $filename;
							}
						else
							{
								return $tmp . "/" . $filename;
							}
					}
			}
		public function AdPiece($adp="tyzm_diamondvote_view",$is_dispaly=0)
			{
			
		}
		
		
		
		
		
		function tpl_input($value = array())
			{
				if (is_array($value))
					{
						
						
						foreach ($value as $row)
							{
								
								$js .= '

				var ' . $row['infotype'] . '=$("*[name=\'' . $row['infotype'] . '\']").val();';
								
								if (!empty($row['notnull']))
									{
										
										$js .= '	

				if(' . $row['infotype'] . '==""){dialog2("请输入' . $row['infoname'] . '");return false;}';
										
									}
								
								switch ($row['infotype'])
								{
										
										case 'mobile':
												
												$html .= '<li><div class="tlt">' . $row['infoname'] . '</div><div class="cont"><input name="' . $row['infotype'] . '"  type="tel" placeholder="请输入' . $row['infoname'] . '" class="tx"></div></li>';
												
												$js .= '

						if(!(/^1[3|4|5|6|7|8|9][0-9]\d{8}$/.test(mobile))){dialog2("请输入正确的手机号码！");return false; } ';
												
												break;
										
										case 'email':
												
												$html .= '<li><div class="tlt">' . $row['infoname'] . '</div><div class="cont"><input name="' . $row['infotype'] . '"  type="text" placeholder="请输入' . $row['infoname'] . '" class="tx"></div></li>';
												
												$js .= 'if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){dialog2("请输入正确的电子邮箱！");return false; } ';
												
												break;
										
										case 'vqqcom':
												
												$html .= '<li><div class="tlt">' . $row['infoname'] . '</div><div class="cont"><input name="' . $row['infotype'] . '"  type="text" placeholder="请输入' . $row['infoname'] . '" class="tx"></div><p style="font-size: 0.8em;color: #960f0f;">至腾讯视频播放页面，复制浏览器地址。</p>

						</li>';
												
												break;
										
										case 'sex':
												
												$html .= '<li><div class="tlt">' . $row['infoname'] . '</div><input name="' . $row['infotype'] . '" type="radio" value="2" checked> 女　　<input name="' . $row['infotype'] . '" type="radio" value="1" style="margin-left:5%"> 男</li>			';
												
												$js .= '

						var ' . $row['infotype'] . '=$("input[name=\'' . $row['infotype'] . '\']:checked").val();';
												
												break;
										
										case 'bio':
										
										case 'interest':
												
												$html .= '<li><div class="tlt">' . $row['infoname'] . '</div>

						<div class="cont">

							<textarea name="' . $row['infotype'] . '" class="ta"  placeholder="请输入' . $row['infoname'] . '"></textarea></div>

						</li>';
												
												break;
										
										default:
												
												$html .= '<li><div class="tlt">' . $row['infoname'] . '</div><div class="cont"><input name="' . $row['infotype'] . '"  type="text" placeholder="请输入' . $row['infoname'] . '" class="tx"></div></li>';
												
												break;
												
								}
								
								
								
								$input .= $row['infotype'] . ":" . $row['infotype'] . ",";
								
							}
					}
				
				
				
				
				
				$res = array(
						$html,
						$js,
						$input
				);
				
				return $res;
				
				
				
			}
		
		function tpl_inputweb($styp = array(), $value = array())
			{
				
				foreach ($styp as $key => $row)
					{
						
						
						
						switch ($row['infotype'])
						{
								
								case 'sex':
										
										$html .= '<div class="form-group">

					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> ' . $row["infoname"] . '</label>

					<div class="col-sm-8 col-xs-12">

						<input type="text" class="form-control" name="join[' . $row["infoname"] . ']" value="' . $value[$key]["val"] . '"/>

						<span class="help-block">2为“女”，1为“男”</span>

					</div>

				</div>  ';
										
										
										
										break;
								
								case 'bio':
								
								case 'interest':
										
										$html .= '<div class="form-group">

					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> ' . $row["infoname"] . '</label>

					<div class="col-sm-8 col-xs-12">

						<textarea name="join[' . $row["infoname"] . ']" class="form-control js-a" cols="30" rows="2">' . $value[$key]["val"] . '</textarea>

						<span class="help-block"></span>

					</div>

				   </div>  ';
										
										break;
								
								default:
										
										$html .= '<div class="form-group">

					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> ' . $row["infoname"] . '</label>

					<div class="col-sm-8 col-xs-12">

						<input type="text" class="form-control" name="join[' . $row["infoname"] . ']" value="' . $value[$key]["val"] . '"/>

						<span class="help-block"></span>

					</div>

				   </div>  ';
										
										break;
										
										
										
						}
						
						
						
						
						
					}
				
				
				
				
				
				
				
				return $html;
				
				
				
			}
		
		
		
		function tpl_app_form_field_image_tyzm($name, $value = '', $rid)
			{
				
				global $_W;
				
				$thumb = empty($value) ? 'images/global/nopic.jpg' : $value;
				
				$thumb = tomedia($thumb);
				
				$file = "index.php?i=" . $_W['uniacid'] . "&c=entry&do=file&m=tyzm_diamondvote&rid=" . $rid;
				
				$html = <<<EOF

	<div class="mui-table-view-chevron">

		<div class="mui-image-uploader">

			<a href="javascript:;" class="mui-upload-btn mui-pull-right js-image-{$name}"></a>

			<div class="mui-image-preview js-image-preview mui-pull-right"></div>

		</div>

	</div>

	<script>

		util.image($('.js-image-{$name}'), function(url){

			$('.js-image-{$name}').parent().find('.js-image-preview').append('<input type="hidden" value="'+url.attachment+'" name="{$name}[]" /><img src="'+url.url+'" data-id="'+url.id+'" data-preview-src="" data-preview-group="__IMG_UPLOAD_{$name}" />');

		}, {

			crop : false,

			multiple : true,

			server:"{$file}",

			preview : '__IMG_UPLOAD_{$name}'

		});

	</script>

EOF;
				
				return $html;
				
			}
		
		function tpl_app_form_field_video_tyzm($name, $value = '', $rid)
			{
				
				
				global $_W;
				$agent = Agent::getDeviceInfo();
				$thumb = empty($value) ? 'images/global/nopic.jpg' : $value;
				
				$thumb = tomedia($thumb);
				
				$file = "index.php?i=" . $_W['uniacid'] . "&c=entry&do=file&m=tyzm_diamondvote&type=video&rid=" . $rid;
				if($agent['osType'] == '1'){
					
				$html = <<<EOF

	<div class="mui-table-view-chevron">

		<div class="mui-image-uploader">

			<a href="javascript:;" class="mui-upload-btn mui-pull-right js-image-{$name}"></a>

			<div class="mui-image-preview js-image-preview mui-pull-right"></div>

		</div>

	</div>

	<script>

		util.image($('.js-image-{$name}'), function(url){

			$('.js-image-{$name}').parent().find('.js-image-preview').append('<input type="hidden" value="'+url.attachment+'" name="{$name}[]" /><img src="../addons/tyzm_diamondvote/template/static/images/video_play.png" data-id="'+url.id+'" data-preview-src="" data-preview-group="__IMG_UPLOAD_{$name}" />');
			
			$('.js-image-{$name}').hide();

		}, {

			crop : false,

			multiple : true,

			server:"{$file}",

			preview : '__IMG_UPLOAD_{$name}'

		});

	</script>

EOF;
				}else{
					
				$html = <<<EOF

	<div class="mui-table-view-chevron">

		<div class="mui-image-uploader" style="height:15px">
			<input type="hidden" value="" name="{$name}[]" />
			 <input type="file"  id="upload_{$name}" style="display: none;" onchange="changeVideo();"> 
			<div class="mui-pull-right" onclick="openFile();"><img id="{$name}img" src="../addons/tyzm_diamondvote/template/static/images/jia.gif"></div>

		</div>

	</div>

	<script>
		function openFile(){  
			$("#upload_{$name}").click();
		} 
		function changeVideo(){
			 var fileObj = document.getElementById("upload_{$name}").files[0];
               if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
                   alert("请选择视频");
                   return;
               }
               var formFile = new FormData(); 
               formFile.append("file", fileObj);
               var data = formFile;
			   loadingToast("正在上传视频...");
               $.ajax({
                   url: "{$file}",
                   data: data,
                   type: "Post",
                   cache: false,
                   processData: false,
                   contentType: false,
                   success: function (result) {
                      $("input[name='{$name}[]']").val(JSON.parse(result).attachment);
					  $('#{$name}img').attr('src','../addons/tyzm_diamondvote/template/static/images/video_play.png');
					  hidemod("loadingToast");
                   },
					error:function(returndata){
					  hidemod("loadingToast");
				}
               })
		} 

	</script>

EOF;
				}
				
				return $html;
				
			}
		
		function tpl_form_field_image_tyzm($name, $value = '', $default = '', $options = array())
			{
				
				global $_W;
				
				if (empty($default))
					{
						
						$default = './resource/images/nopic.jpg';
						
					}
				
				$val = $default;
				
				if (!empty($value))
					{
						
						$val = tomedia($value);
						
					}
				
				if (!empty($options['global']))
					{
						
						$options['global'] = true;
						
					}
				else
					{
						
						$options['global'] = false;
						
					}
				
				if (empty($options['class_extra']))
					{
						
						$options['class_extra'] = '';
						
					}
				
				if (isset($options['dest_dir']) && !empty($options['dest_dir']))
					{
						
						if (!preg_match('/^\w+([\/]\w+)?$/i', $options['dest_dir']))
							{
								
								exit('图片上传目录错误,只能指定最多两级目录,如: "we7_store","we7_store/d1"');
								
							}
						
					}
				
				$options['server'] = "index.php?i=" . $_W['uniacid'] . "&c=entry&do=file&m=tyzm_diamondvote&rid=" . $rid;
				;
				
				$options['direct'] = true;
				
				$options['multiple'] = false;
				
				if (isset($options['thumb']))
					{
						
						$options['thumb'] = !empty($options['thumb']);
						
					}
				
				$options['fileSizeLimit'] = intval($GLOBALS['_W']['setting']['upload']['image']['limit']) * 1024;
				
				$s = '';
				
				if (!defined('TPL_INIT_IMAGE'))
					{
						
						$s = '

		<script type="text/javascript">

			function showImageDialog(elm, opts, options) {

				require(["util"], function(util){

					var btn = $(elm);

					var ipt = btn.parent().prev();

					var val = ipt.val();

					var img = ipt.parent().next().children();

					options = ' . str_replace('"', '\'', json_encode($options)) . ';

					util.image(val, function(url){

						if(url.url){

							if(img.length > 0){

								img.get(0).src = url.url;

							}

							ipt.val(url.attachment);

							ipt.attr("filename",url.filename);

							ipt.attr("url",url.url);

						}

						if(url.media_id){

							if(img.length > 0){

								img.get(0).src = "";

							}

							ipt.val(url.media_id);

						}

					}, options);

				});

			}

			function deleteImage(elm){

				$(elm).prev().attr("src", "./resource/images/nopic.jpg");

				$(elm).parent().prev().find("input").val("");

			}

		</script>';
						
						define('TPL_INIT_IMAGE', true);
						
					}
				
				
				
				$s .= '

		<div class="input-group ' . $options['class_extra'] . '">

			<input type="text" name="' . $name . '" value="' . $value . '"' . ($options['extras']['text'] ? $options['extras']['text'] : '') . ' class="form-control" autocomplete="off">

			<span class="input-group-btn">

				<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>

			</span>

		</div>

		<div class="input-group ' . $options['class_extra'] . '" style="margin-top:.5em;">

			<img src="' . $val . '" onerror="this.src=\'' . $default . '\'; this.title=\'图片未找到.\'" class="img-responsive img-thumbnail" ' . ($options['extras']['image'] ? $options['extras']['image'] : '') . ' width="150" />

			<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>

		</div>';
				
				return $s;
				
			}
		
		
		
		function tpl_footer()
			{
				
				global $_W;
				
				$html = '

<script>
function dialog2(msg){$("#dialog2 .weui-dialog__bd").html(msg);$("#dialog2").show()}function hidemod(boxid){$("#"+boxid).hide()}function loadingToast(msg){$("#loadingToast .weui-toast__content").html(msg);$("#loadingToast").show()}function toast(msg){$("#toast .weui-toast__content").html(msg);$("#toast").show();setTimeout("hidemod(\'toast\')",3000)}var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?08c6f5e17c0761a968c5658ccf6ff5ad";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();</script>
';
				return $html;
				
			}

					function tplmobile() {
		global $_W;
		$template=array(
		    "default_new"=>array(
			    "title"=>"默认模板",
				"icon"=>"icon.jpg",
				"style"=>array(
				    'default'=>array("css"=>"index","color"=>"#ccc"),
					'yellow'=>array("css"=>"default_yellow","color"=>"#fff900"),
					'blue'=>array("css"=>"default_blue","color"=>"#04b0f5"),
					'purple'=>array("css"=>"default_purple","color"=>"#c400d0"),
				)
			),
		);
		
		$template['hengpai']=array(
		    "title"=>"横批模板1",
			"icon"=>"hengpai/icon.jpg",
			"style"=>array(
			    'default'=>array("css"=>"henpaiindex","color"=>"#ff5959")
			)
		);
		return $template;
	} 

	function tpl_setinput($arrayvalue = array()) {
		if(is_array($arrayvalue)){

		
		foreach (@$arrayvalue as $row) {
				$html .= '
					<div  style="margin-left:-15px;">
					  <div class="col-sm-10" style="margin-bottom:10px">
						<div class="input-group">
						  <input type="text" class="form-control" name="infoname[]" value="'.$row['infoname'].'" placeholder="请输入表单名称">
						  <span class="input-group-addon"></span>
						  <select  class="form-control" name="infotype[]">
							<option value="">请选择输入类型</option>
							<option value="realname"' . (($row['infotype'] == "realname") ? 'selected ="selected"' : '') . '  >真实姓名</option>
							<option value="mobile" ' . (($row['infotype'] == "mobile") ? 'selected ="selected"' : '') . ' >手机号码</option>
							<option value="email" ' . (($row['infotype'] == "email") ? 'selected ="selected"' : '') . ' >电子邮箱</option>
							<option value="sex" ' . (($row['infotype'] == "sex") ? 'selected ="selected"' : '') . ' >性别</option>
							<option value="qq" >QQ号</option>
							<option value="birthyear" >出生生日</option>
							<option value="telephone"' . (($row['infotype'] == "telephone") ? 'selected ="selected"' : '') . ' >固定电话</option>
							<option value="idcard" ' . (($row['infotype'] == "idcard") ? 'selected ="selected"' : '') . '>证件号码</option>
							<option value="address" ' . (($row['infotype'] == "address") ? 'selected ="selected"' : '') . '>邮寄地址</option>
							<option value="zipcode"' . (($row['infotype'] == "zipcode") ? 'selected ="selected"' : '') . ' >邮编</option>
							<option value="nationality" ' . (($row['infotype'] == "nationality") ? 'selected ="selected"' : '') . '>国籍</option>
							<option value="resideprovince"' . (($row['infotype'] == "resideprovince") ? 'selected ="selected"' : '') . ' >居住地址</option>
							<option value="graduateschool" ' . (($row['infotype'] == "graduateschool") ? 'selected ="selected"' : '') . '>毕业学校</option>
							<option value="company"' . (($row['infotype'] == "company") ? 'selected ="selected"' : '') . ' >公司</option>
							<option value="education" ' . (($row['infotype'] == "education") ? 'selected ="selected"' : '') . '>学历</option>
							<option value="occupation" ' . (($row['infotype'] == "occupation") ? 'selected ="selected"' : '') . '>职业</option>
							<option value="position" ' . (($row['infotype'] == "position") ? 'selected ="selected"' : '') . '>职位</option>
							<option value="revenue" ' . (($row['infotype'] == "revenue") ? 'selected ="selected"' : '') . '>年收入</option>
							<option value="affectivestatus" ' . (($row['infotype'] == "affectivestatus") ? 'selected ="selected"' : '') . '>情感状态</option>
							<option value="lookingfor"' . (($row['infotype'] == "lookingfor") ? 'selected ="selected"' : '') . ' > 交友目的</option>
							<option value="bloodtype"' . (($row['infotype'] == "bloodtype") ? 'selected ="selected"' : '') . ' >血型</option>
							<option value="height"' . (($row['infotype'] == "height") ? 'selected ="selected"' : '') . ' >身高</option>
							<option value="weight" ' . (($row['infotype'] == "weight") ? 'selected ="selected"' : '') . '>体重</option>
							<option value="alipay" ' . (($row['infotype'] == "alipay") ? 'selected ="selected"' : '') . '>支付宝帐号</option>
							<option value="taobao"' . (($row['infotype'] == "taobao") ? 'selected ="selected"' : '') . ' >阿里旺旺</option>
							<option value="vqqcom"' . (($row['infotype'] == "vqqcom") ? 'selected ="selected"' : '') . ' >腾讯视频</option>
							<option value="site"' . (($row['infotype'] == "site") ? 'selected ="selected"' : '') . ' >主页</option>
							<option value="bio" ' . (($row['infotype'] == "bio") ? 'selected ="selected"' : '') . '>自我介绍</option>
							<option value="interest" ' . (($row['infotype'] == "interest") ? 'selected ="selected"' : '') . '>兴趣爱好</option>

						  </select>
							 <div class="input-group-btn" style="width:95px">
								<select  class="form-control" name="notnull[]">
												<option value="1" ' . (($row['notnull'] == "1") ? 'selected ="selected"' : '') . ' >必填</option>
												<option value="0" ' . (($row['notnull'] == "0") ? 'selected ="selected"' : '') . ' >非必填</option>
								</select>
							 </div>
							 <div class="input-group-btn" style="width:130px">
								<select  class="form-control" name="isshow[]">
												<option value="0" ' . (($row['isshow'] == "0") ? 'selected ="selected"' : '') . ' >前台不显示</option>
												<option value="1" ' . (($row['isshow'] == "1") ? 'selected ="selected"' : '') . ' >前台显示</option>
								</select>
							 </div>
						</div>
					  </div>
					  <div class="col-sm-1 del_box" style="margin-top:5px" ><a href="javascript:;" ><i class="fa fa-times-circle"></i></a></div>
					</div>				
				';
		}
		}
		return $html;
		
	}
	
		
		
		
	}