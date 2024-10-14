<?php
#
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
# 
// use App\Controllers\TokenCsrfController;
// use App\Controllers\SystemMessageController;
// use App\Controllers\ObjetoDbController;
// use App\Controllers\SystemUploadDbController;
# 
use Exception;

class SystemCalendarController extends ResourceController
{
    use ResponseTrait;
    private $ModelResponse;
    private $uri;
    private $tokenCsrf;
    private $DbController;
    private $message;

    public function __construct()
    {
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        // $this->DbController = new ObjetoDbController();
        // $this->tokenCsrf = new TokenCsrfController();
        // $this->message = new SystemMessageController();
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function index($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

    // use App\Controllers\SystemCalendarController;
    // $this->calendario = new SystemCalendarController();
    // private $calendario;
    // $getDiasMes = $this->calendario->getDiasMes($parameter1, $parameter2);
    public function getDiasMes($parameter1, $parameter2)
    {
        // Recebe o ano e o mês da requisição
        $ano = (int) $parameter1;
        $mes = (int) $parameter2;

        try {
            // Verifica se o ano e o mês são válidos
            if ($ano < 1900 || $ano > (int) date("Y") + 5 || $mes < 1 || $mes > 12) {
                return [
                    'dias' => [],
                    'error' => 'Data inválida.'
                ];
            }

            // Define os nomes dos meses em português
            $mesesPortugues = [
                1 => 'Janeiro',
                2 => 'Fevereiro',
                3 => 'Março',
                4 => 'Abril',
                5 => 'Maio',
                6 => 'Junho',
                7 => 'Julho',
                8 => 'Agosto',
                9 => 'Setembro',
                10 => 'Outubro',
                11 => 'Novembro',
                12 => 'Dezembro',
            ];

            // Função auxiliar para calcular o número de dias no mês anterior
            $getPreviousMonthDays = function ($year, $month) {
                if ($month == 1) {
                    $month = 12;
                    $year--;
                } else {
                    $month--;
                }
                return cal_days_in_month(CAL_GREGORIAN, $month, $year);
            };

            // Obtém o número de dias no mês/ano informado
            $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

            // Calcula o primeiro dia do mês atual para ajustar o preenchimento
            $dataPrimeiroDia = sprintf('%d-%02d-01', $ano, $mes);
            $diaSemanaPrimeiroDia = date('w', strtotime($dataPrimeiroDia)); // Retorna o dia da semana (0-6, onde 0 é domingo)

            // Calcular o número de dias do mês anterior para preencher até o domingo
            $diasDoMesAnterior = $getPreviousMonthDays($ano, $mes);
            $diasPreencherAntes = $diaSemanaPrimeiroDia == 0 ? 0 : $diaSemanaPrimeiroDia;

            // Adiciona os dias do mês anterior, começando no domingo
            $dias = [];
            $mesAnterior = $mes == 1 ? 12 : $mes - 1;
            $anoAnterior = $mes == 1 ? $ano - 1 : $ano;
            for ($i = $diasDoMesAnterior - $diasPreencherAntes + 1; $i <= $diasDoMesAnterior; $i++) {
                $data = sprintf('%d-%02d-%02d', $anoAnterior, $mesAnterior, $i);
                $diaSemana = date('l', strtotime($data));
                $dias[] = [
                    'dia' => str_pad($i, 2, '0', STR_PAD_LEFT),
                    'semana' => $this->getDiaSemanaPortugues($diaSemana),
                    'mes' => str_pad($mesAnterior, 2, '0', STR_PAD_LEFT),
                    'text_mes' => $mesesPortugues[$mesAnterior],
                    'ano' => $anoAnterior
                ];
            }

            // Adiciona os dias do mês atual
            for ($dia = 1; $dia <= $diasNoMes; $dia++) {
                $data = sprintf('%d-%02d-%02d', $ano, $mes, $dia);
                $diaSemana = date('l', strtotime($data));
                $dias[] = [
                    'dia' => str_pad($dia, 2, '0', STR_PAD_LEFT),
                    'semana' => $this->getDiaSemanaPortugues($diaSemana),
                    'mes' => str_pad($mes, 2, '0', STR_PAD_LEFT),
                    'text_mes' => $mesesPortugues[$mes],
                    'ano' => $ano
                ];
            }

            // Preenche os dias do mês seguinte até completar 42 dias
            $totalDias = count($dias);
            $mesSeguinte = $mes == 12 ? 1 : $mes + 1;
            $anoSeguinte = $mes == 12 ? $ano + 1 : $ano;
            for ($dia = 1; $totalDias < 42; $dia++) {
                $data = sprintf('%d-%02d-%02d', $anoSeguinte, $mesSeguinte, $dia);
                $diaSemana = date('l', strtotime($data));
                $dias[] = [
                    'dia' => str_pad($dia, 2, '0', STR_PAD_LEFT),
                    'semana' => $this->getDiaSemanaPortugues($diaSemana),
                    'mes' => str_pad($mesSeguinte, 2, '0', STR_PAD_LEFT),
                    'text_mes' => $mesesPortugues[$mesSeguinte],
                    'ano' => $anoSeguinte
                ];
                $totalDias++;
            }

        } catch (\Exception $e) {
            $this->message->message(['ERRO: ' . $e->getMessage()], 'danger');
            myPrint($e->getMessage(), 'src\app\Controllers\SystemCalendarController.php');
        }

        // Retorna o array de dias como JSON
        return [
            'ano' => $ano,
            'mes' => $mesesPortugues[$mes],
            'dias' => $dias
        ];
    }

    // Função auxiliar para obter o dia da semana em português
    private function getDiaSemanaPortugues($diaIngles)
    {
        $diasSemanaPortugues = [
            'Monday' => 'segunda',
            'Tuesday' => 'terça',
            'Wednesday' => 'quarta',
            'Thursday' => 'quinta',
            'Friday' => 'sexta',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo',
        ];
        return $diasSemanaPortugues[$diaIngles] ?? $diaIngles;
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function create_update($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbDelete($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbClear($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
}
#
?>