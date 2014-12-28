<?php namespace Congresso\ModuloInscricao\Participante;

use Congresso\ModuloInscricao\Participante\Repositorios\RepositorioParticipante;
use Congresso\ModuloInscricao\Participante\Validacao\ValidacaoParticipante;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloInscricao\Participante\Models\Participante as ModelParticipante;
use Illuminate\Support\Facades\Redirect;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class Participante implements NegocioInterface
{
    protected $repositorioParticipante;

    protected $validacaoParticipante;

    protected $errors;

    public function __construct()
    {
        $participante = new ModelParticipante();

        $this->repositorioParticipante = new RepositorioParticipante($participante);

        $validacao = \App::make('validator');

        $this->validacaoParticipante = new ValidacaoParticipante($validacao);
    }

    public function all($input = null)
    {
        // TODO: Implement all() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save(array $input)
    {
        // TODO: Implement save() method.
        try
        {

            return \DB::connection()->transaction(function() use ($input){

                $this->validacaoParticipante->with($input);

                if(!$this->validacaoParticipante->passes()){
                    return $this->validacaoParticipante->errors();
                }

                $dados['part_nome_completo']                = $input['nomeCompleto'];
                $dados['part_nome_cracha']                  = $input['nomeCracha'];
                $dados['part_cpf']                          = self::removeCaracter($input['cpf'], ['.', '-'], ['','']);
                $dados['part_rg']                           = $input['rg'];
                $dados['part_data_nascimento']              = $input['dataNascimento'];
                $dados['part_endereco']                     = $input['endereco'];
                $dados['cod_municipios']                    = $input['municipio'];
                $dados['part_telefone_residencial']         = $input['telefoneResidencial'];
                $dados['part_telefone_celular']             = $input['telefoneCelular'];
                $dados['part_email']                        = $input['email'];
                $dados['cod_instituicao']                   = $input['instituicao'];
                $dados['cod_sexo']                          = $input['sexo'];
                $dados['part_tipo_deficiencia']             = $input['necessidadeEspecial'];
                $dados['part_motivacao']                    = $input['motivacao'];

                $salvar = $this->repositorioParticipante->save($dados);

                if(!$salvar){
                    throw new \AppException('Não foi possivel salvar os dados');
                }

//                $paymentRequest = new \PagSeguroPaymentRequest();
//                $paymentRequest->addItem('001', 'Inscrição Congresso Juventude', 1, 50.00);
//
//                $paymentRequest->setSenderName($input['nomeCompleto']);
//                $paymentRequest->setSenderEmail($input['email']);
//                $paymentRequest->setSenderPhone('71', $input['telefoneCelular']);
//
//                $paymentRequest->setCurrency('BRL');
//
//                $paymentRequest->setReference('PAGJUV2015');
//
//                $paymentRequest->setRedirectURL('http://congresso-juventudes.dev/agradeco');
//
//                $credentials = \PagSeguroConfig::getAccountCredentials();
//                $checkoutUrl = $paymentRequest->register($credentials);
//
//                dd($checkoutUrl);

                $credentials = new Credentials(
                    'allan.frb@gmail.com',
                    'E2CAF93880C44BA2AB8AA5D24AA3B8A9',
                    new Sandbox()
                );

                $service = new CheckoutService($credentials);

                $checkout = $service->createCheckoutBuilder()
                                    ->addItem(new Item(1, 'Inscricao Congresso', 50.00))

                                    ->getCheckout();

                $response = $service->checkout($checkout);

                //header('Location: '. $response->getRedirectionUrl());

                return $response->getRedirectionUrl();

                return true;
            });

        }catch (\AppException $e)
        {
            $this->errors = $e->getMensagem();

            return false;
        }
    }

    public function update(array $input, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getErrors()
    {
        // TODO: Implement getErrors() method.
        return $this->errors;
    }

    protected function removeCaracter($valor, $procurar, $substituir)
    {
        $input = str_replace($procurar, $substituir, $valor);

        return $input;
    }

}