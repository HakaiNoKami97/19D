<?PHP

require_once('../../libraries/rutas.php');
require_once(rutaBase . 'php' . DS . 'libraries' . DS . 'validaciones.php');

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Incoming\Answer;

class conversacion extends Conversation
{

    // 1 - BERNARDINO
    // 2 - MESSENGER

    protected $ArrayConversacion;
    protected $bEnviar;
    protected $tipoBot;

    public function __construct()
    {
        $this->ArrayConversacion = [];
    }

    function getArrayConversacion()
    {
        return $this->ArrayConversacion;
    }

    // Tipo de documento que se enviara
    function setArrayConversacion($ArrayConversacion)
    {
        $this->ArrayConversacion[] = $ArrayConversacion;
    }

    function getBEnviar()
    {
        return $this->bEnviar;
    }

    // Tipo de documento que se enviara
    function setBEnviar($BEnviar)
    {
        $this->bEnviar = $BEnviar;
    }

    function getTipoBot()
    {
        return $this->tipoBot;
    }

    // Tipo de documento que se enviara
    function setTipoBot($tipoBot)
    {
        $this->tipoBot = $tipoBot;
    }

    public function askAyuda()
    {
        date_default_timezone_set('America/Bogota');
        $horaActual = date('Y-m-d H:i');
        if(is_array($this->bot->getMessage()->getPayload()["message"])){
            $this->setArrayConversacion(array($this->bot->getMessage()->getPayload()["message"]["text"], 1, $horaActual));
            $this->say('¡Hola! Soy Bernardino, Bienvenido a RVO');
            $this->setArrayConversacion(array('¡Hola! Soy Bernardino, Bienvenido a RVO', 2, $horaActual));
            // $mensaje = $this->bot->getMessage()->getPayload()["message"]["text"];
            $this->setTipoBot(2);
        }else{
            $this->setArrayConversacion(array('¡Hola! Soy Bernardino, Bienvenido a RVO', 2, $horaActual));
            $this->setArrayConversacion(array($this->bot->getMessage()->getPayload()["message"], 1, $horaActual));
            // $mensaje = $this->bot->getMessage()->getPayload()["message"];
            $this->setTipoBot(1);
        }
        // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
        // if ($fp) {
        //     fwrite($fp, "----------------------NUEVA CONVERSACIÓN----------------------" . PHP_EOL);
        //     fwrite($fp, "[" . $horaActual . "] Bernardino : ¡Hola! Soy Bernardino, Bienvenido a RVO" . PHP_EOL);
        //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $mensaje . PHP_EOL);
        //     fwrite($fp, "[" . $horaActual . "] Bernardino : ¿En que estas interesado/a?" . PHP_EOL);
        //     fclose($fp);
        // }
        $this->setArrayConversacion(array('¿En que estas interesado/a?', 2, $horaActual));
        $this->ask('¿En que estas interesado/a?', function ($answer) {
            date_default_timezone_set('America/Bogota');
            $horaActual = date('Y-m-d H:i');
            $interesado = $answer->getText();
            $this->setArrayConversacion(array($interesado, 1, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $interesado . PHP_EOL);
            //     fclose($fp);
            // }
            $this->askNombres();
        });
    }

    public function askNombres()
    {
        date_default_timezone_set('America/Bogota');
        $horaActual = date('Y-m-d H:i');
        $this->bot->typesAndWaits(3);
        $this->setArrayConversacion(array('Será un placer asistirte, ¿Cuál es tu nombre?', 2, $horaActual));
        // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
        // if ($fp) {
        //     fwrite($fp, "[" . $horaActual . "] Bernardino : Será un placer asistirte, ¿Cuál es tu nombre?" . PHP_EOL);
        //     fclose($fp);
        // }
        $this->ask('Será un placer asistirte, ¿Cuál es tu nombre?', function ($answer) {
            date_default_timezone_set('America/Bogota');
            $horaActual = date('Y-m-d H:i');
            $nombres = $answer->getText();
            $this->setArrayConversacion(array($nombres, 1, $horaActual));
            $this->say('Hola ' . $nombres . ', yo me encargo de ponerte en contacto con un asesor para que responda tu consulta');
            $this->setArrayConversacion(array('Hola ' . $nombres . ', yo me encargo de ponerte en contacto con un asesor para que responda tu consulta', 2, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $nombres . PHP_EOL);
            //     fwrite($fp, "[" . $horaActual . "] Bernardino : Hola " . $nombres . ", yo me encargo de ponerte en contacto con un asesor para que responda tu consulta" . PHP_EOL);
            //     fclose($fp);
            // }
            $this->askTelefono(true);
        });
    }

    public function askTelefono($bMensaje)
    {
        date_default_timezone_set('America/Bogota');
        $horaActual = date('Y-m-d H:i');
        $this->bot->typesAndWaits(3);
        if ($bMensaje) {
            $mensaje = '¿Podrías dejarme tu teléfono?';
            $this->setArrayConversacion(array('¿Podrías dejarme tu teléfono?', 2, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Bernardino : ¿Podrías dejarme tu teléfono?" . PHP_EOL);
            //     fclose($fp);
            // }
        } else {
            $mensaje = 'Necesitaría un teléfono valido para que podamos contactarte. Digita de nuevo el teléfono';
            $this->setArrayConversacion(array('Necesitaría un teléfono valido para que podamos contactarte. Digita de nuevo el teléfono', 2, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Bernardino : Necesitaría un teléfono valido para que podamos contactarte. Digita de nuevo el teléfono" . PHP_EOL);
            //     fclose($fp);
            // }
        }

        $this->ask($mensaje, function ($answer) {
            date_default_timezone_set('America/Bogota');
            $horaActual = date('Y-m-d H:i');
            $telefono = $answer->getText();
            $this->setArrayConversacion(array($telefono, 1, $horaActual));
            if (
                validar::patronnumeros($telefono)
            ) {
                // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
                // if ($fp) {
                //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $telefono . PHP_EOL);
                //     fclose($fp);
                // }
                $this->askEmail(true);
            } else {
                // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
                // if ($fp) {
                //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $telefono . PHP_EOL);
                //     fclose($fp);
                // }
                $this->askTelefono(false);
            }
        });
    }

    public function askEmail($bMensaje)
    {
        date_default_timezone_set('America/Bogota');
        $horaActual = date('Y-m-d H:i');
        $this->bot->typesAndWaits(3);
        if ($bMensaje) {
            $mensaje = '¿Podrías dejarme tu email?';
            $this->setArrayConversacion(array('¿Podrías dejarme tu email?', 2, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Bernardino : ¿Podrías dejarme tu email?" . PHP_EOL);
            //     fclose($fp);
            // }
        } else {
            $mensaje = 'Necesitaría un email valido para que podamos contactarte. Digita de nuevo el email';
            $this->setArrayConversacion(array('Necesitaría un email valido para que podamos contactarte. Digita de nuevo el email', 2, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Bernardino : Necesitaría un email valido para que podamos contactarte. Digita de nuevo el email" . PHP_EOL);
            //     fclose($fp);
            // }
        }

        $this->ask($mensaje, function ($answer) {
            date_default_timezone_set('America/Bogota');
            $horaActual = date('Y-m-d H:i');
            $email = $answer->getText();
            $this->setArrayConversacion(array($email, 1, $horaActual));
            if (
                validar::correo($email)
            ) {
                // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
                // if ($fp) {
                //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $email . PHP_EOL);
                //     fclose($fp);
                // }
                $this->askConsultaAdicional();
            } else {
                // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
                // if ($fp) {
                //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $email . PHP_EOL);
                //     fclose($fp);
                // }
                $this->askEmail(false);
            }
        });
    }

    public function askConsultaAdicional()
    {
        date_default_timezone_set('America/Bogota');
        $horaActual = date('Y-m-d H:i');
        $this->bot->typesAndWaits(3);
        $this->setArrayConversacion(array('¿Quieres dejarme alguna consulta adicional?', 2, $horaActual));
        // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
        // if ($fp) {
        //     fwrite($fp, "[" . $horaActual . "] Bernardino : ¿Quieres dejarme alguna consulta adicional?" . PHP_EOL);
        //     fclose($fp);
        // }
        $this->ask('¿Quieres dejarme alguna consulta adicional?', function ($answer) {
            date_default_timezone_set('America/Bogota');
            $horaActual = date('Y-m-d H:i');
            $consultaAdicional = $answer->getText();
            $this->setArrayConversacion(array($consultaAdicional, 1, $horaActual));
            $this->bot->typesAndWaits(3);
            $this->say('Con la información que me has pasado un asesor se comunicará contigo a la brevedad. Muchas gracias por comunicarte!');
            $this->setArrayConversacion(array('Con la información que me has pasado un asesor se comunicará contigo a la brevedad. Muchas gracias por comunicarte!', 2, $horaActual));
            // $fp = fopen('logs/' . $this->bot->getUser()->getId() . '.txt', 'a');
            // if ($fp) {
            //     fwrite($fp, "[" . $horaActual . "] Cliente : " . $consultaAdicional . PHP_EOL);
            //     fwrite($fp, "[" . $horaActual . "] Bernardino : Con la información que me has pasado un asesor se comunicará contigo a la brevedad. Muchas gracias por comunicarte!" . PHP_EOL);
            //     fclose($fp);
            // }
            $this->enviar_correo();
        });
    }

    public function enviar_correo()
    {
        require_once(rutaBase . 'php' . DS . 'libraries' . DS . 'email.php');
        $array = $this->getArrayConversacion();
        $tipoBot = $this->getTipoBot();
        $arrayRemitentes[0]['correo'] = "rvoips.backup@gmail.com"; //"rvoips.gestordocumentos@gmail.com";// "bernardino@rvo.com.co";
        $arrayRemitentes[0]['contrasenia'] = "Asdf1234*"; //"6229234*";// "Zuqb0frk";

        $arrayDestinatarios[] = "jdmo0802@gmail.com";
        // $arrayDestinatarios[] = "jaime@laboratoriorvo.com";
        $arrayDestinatarios[] = "solicitudes@rvo.com.co";
        $arrayDestinatarios[] = "rvoips.ednagamboa@gmail.com";
        $arrayDestinatarios[] = 'rvoips.silviajariza@gmail.com';
        $arrayDestinatarios[] = "info@rvo.com.co";

        $html = '<html>
        <head>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">           
        </head>
        <body>
        <div style="text-align: center;font-size: 20px;color: rgb(20, 82, 127);font-weight: bold;margin-bottom: 20px;">Hola, ¡Tienes un Nuevo Cliente en Laboratorio RVO!</div>
        <table style="width:50%;border-collapse: collapse;margin: 0 auto;"><thead></thead><tbody>';

        $mensajeSkype = "<b raw_pre='*' raw_post='*'>Hola, ¡Tienes un Nuevo Cliente en Laboratorio RVO!</b>\n\n";
        for ($i = 0; $i < count($array); $i++) {
            $mensajes = $array[$i];
            $mensaje = $mensajes[0];
            $tipo = $mensajes[1];
            $tiempo = $mensajes[2];

            if ($tipo == 1) {
                $mensajetitulo = "Cliente";
            } else if ($tipo == 2) {
                if($tipoBot == 1){
                    $mensajetitulo = "Bernardino";
                }else if($tipoBot == 2){
                    $mensajetitulo = "Bernardino Messenger";
                }
                
            }

            $html .= "<tr><td><span style='font-weight: bold;'>[$tiempo] $mensajetitulo</span> : $mensaje</td></tr>";
            $mensajeSkype .= "[$tiempo] $mensajetitulo : $mensaje\n";
        }

        $html .= '
        </tbody>
        </table>           
        </body>
        </html>';
        // echo $html;
        $envio = email::enviar($arrayRemitentes, $arrayDestinatarios, "ChatBot", $html, array(), array(), array());

        require_once(rutaAbsoluta . DS . 'php' . DS . 'model' . DS . 'modelPeticion.php');
        $arrayDatos = array(
            "peticion" => "enviarMensajeUsuario",
            "usuario" => "JMENDOZA",
            "mensaje" => $mensajeSkype
        );
        modelPeticion::enviarPeticion($arrayDatos);
        $arrayDatos = array(
            "peticion" => "enviarMensajeGrupo",
            "usuario" => "2",
            "mensaje" => $mensajeSkype
        );
        modelPeticion::enviarPeticion($arrayDatos);
    }

    public function run()
    {
        $this->askAyuda();
    }
}
