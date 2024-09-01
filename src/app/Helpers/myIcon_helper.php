<?php
if (!function_exists('listFileIcon')) {
    function listFileIcon()
    {
        $path = APPPATH . 'Views/icon';
        // Verificar se o diretório existe
        if (!file_exists($path)) {
            return 'Diretório não encontrado.';
        }

        $files = scandir($path);

        // Filtrar para remover '.' e '..'
        $files = array_diff($files, array('.', '..'));

        // Remover a extensão .php dos nomes dos arquivos
        $filesWithoutExt = array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);

        // Agora você pode retornar essa lista ou passá-la para uma view
        return $filesWithoutExt;
        // return json_encode($filesWithoutExt);
    }
}

if (!function_exists('listTranslatorIcon')) {
    function listTranslatorIcon($text)
    {
        $translator['01_whatsapp'] = 'Whatsapp';
        $translator['02_youtube'] = 'Youtube';
        $translator['03_instagram'] = 'Instagram';
        $translator['04_facebook'] = 'Facebook';
        $translator['05_tiktok'] = 'TikTok';
        $translator['07_0_twitter'] = 'Twitter';
        $translator['07_1_twitter_x'] = 'Twitter X';
        $translator['07_2_twitch'] = 'Twitch';
        $translator['08_pinterest'] = 'Pinterest';
        $translator['09_linkedin'] = 'LinkedIn';
        $translator['10_snapchat'] = 'Snapchat';
        $translator['11_line'] = 'Line';
        $translator['12_wechat'] = 'Wechat';
        $translator['13_google'] = 'Google';
        $translator['14_git'] = 'Git';
        $translator['15_github'] = 'Git Hub';
        $translator['16_gitlab'] = 'Git Lab';
        #
        $translator['align_end'] = 'Alinhe final';
        $translator['align_start'] = 'Alinhe o início';
        $translator['arrow_bar_bottom'] = 'Baixa da barra de seta';
        $translator['arrow_box _down'] = 'Caixa de seta para baixo';
        $translator['arrow_caret_down'] = 'Arrow Caret Down';
        $translator['arrow_chevron_compact_down'] = 'Arrow Chevron Compact Down';
        $translator['arrow_chevron_double_down'] = 'Arrow Chevron Double Down Down';
        $translator['arrow_down_short'] = 'Seta para baixo';
        $translator['arrow_layer_backward'] = 'Camada de seta para trás';
        $translator['arrow_repeat'] = 'Seta repetir';
        $translator['arrow_reply_fill'] = 'Resposta de seta preenchimento';
        $translator['arrows-expand'] = 'As setas expandem';
        $translator['asterisco_papel'] = 'Asterisco Papel';
        $translator['award_fill'] = 'Preenchimento de prêmio';
        $translator['bookmark_check_fill'] = 'Check -marcado de marcador';
        $translator['calendar2_check'] = 'Calendar2 Verificação';
        $translator['calendar3'] = 'Calendário3';
        $translator['check2_square'] = 'Verificação2 quadrado';
        $translator['check_circle_fill'] = 'Verifique o preenchimento do círculo';
        $translator['clipboard2'] = 'Clipboard2';
        $translator['clipboard2_x_fill'] = 'Clipboard2 x preenchimento';
        $translator['clock'] = 'Relógio';
        $translator['dash_square'] = 'Dash Square';
        $translator['dash_square_2'] = 'Dash Square 2';
        $translator['database_dash'] = 'Banco de dados Dash';
        $translator['database_dash_2'] = 'Banco de dados Dash 2';
        $translator['database_x'] = 'Banco de dados x';
        $translator['database_x_2'] = 'Banco de dados x 2';
        $translator['door_open'] = 'Porta aberta';
        $translator['emoji_frown_fill'] = 'Emoji carranca preenchida';
        $translator['emoji_neutral_fill'] = 'EMOJI NEUTRO ENCHETO';
        $translator['emoji_smile_fill'] = 'Sorriso emoji preenche';
        $translator['eye'] = 'Olho';
        $translator['file_earmark_excel'] = 'Despertar de arquivos Excel';
        $translator['file_earmark_excel_2'] = 'ABERTA DE ARQUIVO EXCEL 2';
        $translator['file_earmark_minus'] = 'Recurso de arquivo menos';
        $translator['file_earmark_minus_2'] = 'Recurso de arquivo menos 2';
        $translator['file_minus'] = 'Arquivo menos';
        $translator['file_minus_2'] = 'Arquivo menos 2';
        $translator['filetype_key'] = 'Chave do FileType';
        $translator['fingerprint'] = 'Impressão digital';
        $translator['folder_minus'] = 'Pasta menos';
        $translator['gear_wide_connected'] = 'Gear larga conectada';
        $translator['geo_alt_fill'] = 'Geo alt preenchimento';
        $translator['globe'] = 'Globo';
        $translator['house_door'] = 'Porta da casa';
        $translator['house_exclamation_fill'] = 'Exclamação da casa preenchida';
        $translator['jornal'] = 'Jornal';
        $translator['jornal_array_down'] = 'Jornal Array Down';
        $translator['jornal_array_up'] = 'Jornal Array Up';
        $translator['journal_minus'] = 'Jornal menos';
        $translator['journal_plus'] = 'Journal Plus';
        $translator['key'] = 'Chave';
        $translator['keyII'] = 'Keyii';
        $translator['list_task'] = 'Tarefa de lista';
        $translator['lista_menu'] = 'Menu Lista';
        $translator['mail_check'] = 'Cheque de correio';
        $translator['paperclip'] = 'Clipe de papel';
        $translator['pencil_square'] = 'Praça de lápis';
        $translator['people'] = 'Pessoas';
        $translator['peopleII'] = 'Peopleii';
        $translator['peopleIII'] = 'Peopleiii';
        $translator['person_fill_check'] = 'Pessoa preenchimento de cheque';
        $translator['person_fill_slash'] = 'Pessoa enche a barra';
        $translator['plus'] = 'Mais';
        $translator['printer'] = 'Impressora';
        $translator['printer_fill'] = 'Preenchimento da impressora';
        $translator['question_circle'] = 'Círculo de perguntas';
        $translator['question_circle2'] = 'Pergunta Circle2';
        $translator['script'] = 'Roteiro';
        $translator['search'] = 'Procurar';
        $translator['seta_direita'] = 'Seta Direita';
        $translator['sliders2_vertical'] = 'Sliders2 Vertical';
        $translator['telephone'] = 'Telefone';
        $translator['trash'] = 'Lixo';
        $translator['ui_checks'] = 'Verificações da interface do usuário';
        $translator['upload'] = 'Carregar';
        $translator['view'] = 'Visualizar';
        $translator['x'] = 'X';
        $translator['x_2'] = 'X 2';
        $translator['bookmark'] = 'Marcador de Livro';
        foreach ($translator as $chave => $valor) {
            if ($chave === $text) {
                $var = $valor;
                break;
            }
        }
        if (isset($var)) {
            return $var;
        } else {
            return $text;
        }
    }
}
