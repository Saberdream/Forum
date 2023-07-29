<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * mod.php
*/
$lang['mod_errors'] = array(
	'not_authorized_access'	=> '您无法访问此部分。',
	'incorrect_forum_id'	=> '论坛 ID 无效。',
	'forum_not_found'	=> '找不到论坛。',
	'not_moderator'	=> '您不是该论坛的版主。',
	'expired_token'	=> '令牌已过期或无效。',
	'no_topic_selected'	=> '尚未选择主题。',
	'incorrect_ids'	=> 'ID 不正确。',
	'incorrect_action'	=> '这个动作是不正确的。',
	'not_authorized_action'	=> '您没有执行此操作所需的权限。',
	'max_sticky_reached'	=> '已达到固定主题的最大数量 (%d)。',
	'topic_not_found'	=> '主题已删除或 ID 不正确。',
	'no_topic_affected'	=> '没有主题/帖子受到查询的影响。',
	'action_success'	=> '操作成功完成，%d 个帖子/主题受到影响。',
	'incorrect_topic_id'	=> '主题 ID 无效。',
	'incorrect_post_id'	=> '消息 ID 不正确。',
	'incorrect_user_id'	=> '用户 ID 不正确。',
	'error_occurred'	=> '发生了错误',
);
