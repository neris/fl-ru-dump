<?php
/* 
 * 
 * Р”Р°РЅРЅС‹Р№ С„Р°Р№Р» СЏРІР»СЏРµС‚СЃСЏ С‡Р°СЃС‚СЊСЋ РїСЂРѕРµРєС‚Р° Р’РµР± РњРµСЃСЃРµРЅРґР¶РµСЂ.
 * 
 * Р’СЃРµ РїСЂР°РІР° Р·Р°С‰РёС‰РµРЅС‹. (c) 2005-2009 РћРћРћ "РўРћРџ".
 * Р”Р°РЅРЅРѕРµ РїСЂРѕРіСЂР°РјРјРЅРѕРµ РѕР±РµСЃРїРµС‡РµРЅРёРµ Рё РІСЃРµ СЃРѕРїСѓС‚СЃС‚РІСѓСЋС‰РёРµ РјР°С‚РµСЂРёР°Р»С‹
 * РїСЂРµРґРѕСЃС‚Р°РІР»СЏСЋС‚СЃСЏ РЅР° СѓСЃР»РѕРІРёСЏС… Р»РёС†РµРЅР·РёРё, РґРѕСЃС‚СѓРїРЅРѕР№ РїРѕ Р°РґСЂРµСЃСѓ
 * http://webim.ru/license.html
 * 
 */
?>
<?php



function smarty_core_run_insert_handler($params, &$smarty)
{

    require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
    if ($smarty->debugging) {
        $_params = array();
        $_debug_start_time = smarty_core_get_microtime($_params, $smarty);
    }

    if ($smarty->caching) {
        $_arg_string = serialize($params['args']);
        $_name = $params['args']['name'];
        if (!isset($smarty->_cache_info['insert_tags'][$_name])) {
            $smarty->_cache_info['insert_tags'][$_name] = array('insert',
                                                             $_name,
                                                             $smarty->_plugins['insert'][$_name][1],
                                                             $smarty->_plugins['insert'][$_name][2],
                                                             !empty($params['args']['script']) ? true : false);
        }
        return $smarty->_smarty_md5."{insert_cache $_arg_string}".$smarty->_smarty_md5;
    } else {
        if (isset($params['args']['script'])) {
            $_params = array('resource_name' => $smarty->_dequote($params['args']['script']));
            require_once(SMARTY_CORE_DIR . 'core.get_php_resource.php');
            if(!smarty_core_get_php_resource($_params, $smarty)) {
                return false;
            }

            if ($_params['resource_type'] == 'file') {
                $smarty->_include($_params['php_resource'], true);
            } else {
                $smarty->_eval($_params['php_resource']);
            }
            unset($params['args']['script']);
        }

        $_funcname = $smarty->_plugins['insert'][$params['args']['name']][0];
        $_content = $_funcname($params['args'], $smarty);
        if ($smarty->debugging) {
            $_params = array();
            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
            $smarty->_smarty_debug_info[] = array('type'      => 'insert',
                                                'filename'  => 'insert_'.$params['args']['name'],
                                                'depth'     => $smarty->_inclusion_depth,
                                                'exec_time' => smarty_core_get_microtime($_params, $smarty) - $_debug_start_time);
        }

        if (!empty($params['args']["assign"])) {
            $smarty->assign($params['args']["assign"], $_content);
        } else {
            return $_content;
        }
    }
}



?>
