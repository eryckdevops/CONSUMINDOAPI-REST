<?php

class APIREST extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function processarEnvioPedidos() {
        $listaPedidosPendentes = $this->obterPedidosPendentesImportacao();
    
        foreach ($listaPedidosPendentes as $pedidoAtual) {
            $itensPedido = array_map(function($itemPedido) {
                return $this->prepararItemPedido($itemPedido);
            }, $pedidoAtual->itens);
    
            $informacoesCliente = $this->prepararDadosCliente($pedidoAtual->cliente);
            $dadosEnvio = $this->montarDadosEnvio($pedidoAtual, $itensPedido, $informacoesCliente);
    
            $this->enviarDadosPedidoParaServidor(json_encode($dadosEnvio));
        }
    }
    

    private function prepararPayloadPedido($pedido, $itens, $cliente) {
        $payload = [
            "idEmpresa" => $pedido->idEmpresa,
            "identificadorVendedor" => $pedido->identificadorVendedor,
            "codigoCliente" => $cliente->codigoCliente,
            "modalidadeFrete" => $pedido->modalidadeFrete,
            "termosPagamento" => $pedido->termosPagamento,
            "idPrecoTabela" => $pedido->idPrecoTabela,
            "tipoNotaFiscal" => $pedido->tipoNotaFiscal,
            "finalidadeOperacao" => $pedido->finalidadeOperacao,
            "dataPedido" => $pedido->dataPedido,
            "horaPedido" => $pedido->horaPedido,
            "canalVendas" => $pedido->canalVendas,
            "referenciaPedidoCliente" => $pedido->referenciaPedidoCliente,
            "observacaoInterna" => $pedido->observacaoInterna,
            "codigoTransportadora" => $pedido->codigoTransportadora,
            "planoCarga" => $pedido->planoCarga,
            "valorTotalItens" => $pedido->valorTotalItens,
            "descontoTotalPedido" => $pedido->descontoTotalPedido,
            "valorTotalIPI" => $pedido->valorTotalIPI,
            "valorTotalICMS" => $pedido->valorTotalICMS,
            "baseCalculoICMS" => $pedido->baseCalculoICMS,
            "baseCalculoIPI" => $pedido->baseCalculoIPI,
            "totalImpostos" => $pedido->totalImpostos,
            "pesoLiquidoTotal" => $pedido->pesoLiquidoTotal,
            "pesoBrutoTotal" => $pedido->pesoBrutoTotal,
            "volumeTotal" => $pedido->volumeTotal,
            "numeroFatura" => $pedido->numeroFatura,
            "serieFatura" => $pedido->serieFatura,
            "valorFreteEstimado" => $pedido->valorFreteEstimado,
            "valorSeguroEstimado" => $pedido->valorSeguroEstimado,
            "outrasDespesasAcessorias" => $pedido->outrasDespesasAcessorias,
            "dataPrevistaEntrega" => $pedido->dataPrevistaEntrega,
            "localEntrega" => $pedido->localEntrega,
            "condicaoEntrega" => $pedido->condicaoEntrega,
            "produtos" => array_map(function($produto) {
                return [
                    "refProduto" => $produto->refProduto,
                    "qtd" => $produto->qtd,
                    "valorUnitario" => $produto->valorUnitario,
                    "subtotalProduto" => $produto->subtotalProduto,
                    "taxaICMS" => $produto->taxaICMS,
                    "taxaIPI" => $produto->taxaIPI,
                    "taxaST" => $produto->taxaST,
                    "baseCalcICMS" => $produto->baseCalcICMS,
                    "baseCalcIPI" => $produto->baseCalcIPI,
                    "baseCalcST" => $produto->baseCalcST,
                    "promo" => $produto->promo,
                    "lote" => $produto->lote,
                    "validade" => $produto->validade,
                    "descPercentual" => $produto->descPercentual,
                    "valorDesc" => $produto->valorDesc,
                    "custoFrete" => $produto->custoFrete,
                    "seq" => $produto->seq,
                    "codigoNCM" => $produto->codigoNCM,
                    "codigoCEST" => $produto->codigoCEST,
                ];
            }, $pedido->produtos),
            "enderecoEntrega" => [ 
                "rua" => $pedido->enderecoEntrega->rua,
                "num" => $pedido->enderecoEntrega->num,
                "complemento" => $pedido->enderecoEntrega->complemento,
                "bairro" => $pedido->enderecoEntrega->bairro,
                "cidade" => $pedido->enderecoEntrega->cidade,
                "estado" => $pedido->enderecoEntrega->estado,
                "cep" => $pedido->enderecoEntrega->cep,
                "pais" => $pedido->enderecoEntrega->pais,
                "pontoReferencia" => $pedido->enderecoEntrega->pontoReferencia,
            ],
            "dadosAdicionais" => [
                "dataEmissao" => $pedido->dadosAdicionais->dataEmissao,
                "dataEntregaPrevista" => $pedido->dadosAdicionais->dataEntregaPrevista,
                "formaPagamento" => $pedido->dadosAdicionais->formaPagamento,
                "instrucoesEspeciais" => $pedido->dadosAdicionais->instrucoesEspeciais,
            ],
            "detalhesPagamento" => [
                "totalPedido" => $pedido->detalhesPagamento->totalPedido,
                "totalDescontos" => $pedido->detalhesPagamento->totalDescontos,
                "totalAcrescimos" => $pedido->detalhesPagamento->totalAcrescimos,
                "valorFinal" => $pedido->detalhesPagamento->valorFinal,
                "metodoPagamento" => $pedido->detalhesPagamento->metodoPagamento,
            ],
            "informacoesEntrega" => [
                "tipoEntrega" => $pedido->informacoesEntrega->tipoEntrega,
                "prazoEntregaDias" => $pedido->informacoesEntrega->prazoEntregaDias,
                "custoEntrega" => $pedido->informacoesEntrega->custoEntrega,
            ],
        ];
        
            

       
        return json_encode($payload, JSON_PRETTY_PRINT);
    }
    
    private function enviarDadosPedidoParaServidor($dadosJson) {
        $enderecoServidor = "http://";
        $credenciaisAutenticacao = $this->obterCredenciaisAutenticacao();
        
        $sessaoCurl = curl_init($enderecoServidor);
        curl_setopt($sessaoCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($sessaoCurl, CURLOPT_POST, true);
        curl_setopt($sessaoCurl, CURLOPT_POSTFIELDS, $dadosJson);
        curl_setopt($sessaoCurl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $credenciaisAutenticacao,
        ]);
        
        $respostaServidor = curl_exec($sessaoCurl);
        $codigoStatusHttp = curl_getinfo($sessaoCurl, CURLINFO_HTTP_CODE);
        
        if (curl_errno($sessaoCurl)) {
            throw new Exception('Erro na comunicação com o servidor: ' . curl_error($sessaoCurl));
        }
        
        if ($codigoStatusHttp != 200) {
            $respostaDecodificada = json_decode($respostaServidor, true);
            throw new Exception("Resposta do servidor com código: $codigoStatusHttp e detalhes: " . print_r($respostaDecodificada, true));
        }
        
        curl_close($sessaoCurl);
        
        return json_decode($respostaServidor, true);
    }
    
    private function obterCredenciaisAutenticacao() {
        $nomeUsuario = '';
        $senhaUsuario = '';
        return base64_encode($nomeUsuario . ":" . $senhaUsuario);
    }
    
?>
