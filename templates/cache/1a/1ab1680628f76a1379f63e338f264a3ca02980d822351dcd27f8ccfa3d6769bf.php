<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* reservation.html */
class __TwigTemplate_bb219b850fa51eb2db286b85066e85e0863c9048efa94f39c76e1cd5b87ada16 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Demande de devis</title>
    <style type=\"text/css\">
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap\" rel=\"stylesheet');

        p, span, h1, h2, h3, h4, ol, li, ul, td, th {
            font-family: 'Roboto', sans-serif;
        }

        body {
        }

        .page {
            display: block;
            padding-bottom: 40px;
            padding-top: 20px;
            color: white;
            background-color: #003B80;
        }

        .header {
            padding-left: 40px;
        }

        .header .row-flex {
            display: flex;
            flex-direction: row;
        }

        .row .f-auto {
            flex: auto;
            width: 150px;
        }

        .row .f-1 {
            flex: 1;
        }

        .page .content {
            margin-top: 25px;
            min-height: 100px;
            padding-left: 40px;
            padding-right: 40px;
            margin-bottom: 80px;
        }

        .content > .content-wrapper {
            padding-left: 15px;
            word-wrap: normal;
        }

        h1 {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 0px;
        }

        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid white;
        }

        td {
            padding: 8px;
        }

    </style>
</head>
<body>
<div class=\"page\">
    <div class=\"header\">
        <div class=\"row-flex\">
            <div class=\"f-auto\">
                <img src=\"";
        // line 82
        echo twig_escape_filter($this->env, ($context["logo"] ?? null), "html", null, true);
        echo "\" width=\"250\" alt=\"\"/>
            </div>
            <div class=\"f-1\" style=\"background-color: yellow\"></div>
        </div>
    </div>
    <div class=\"content\">
        <div class=\"content-wrapper\">
            <h1>DEMANDE DE DEVIS</h1>
            <p>Maxime aliquam iure architecto suscipit modi possimus autem nam dolorem rem sequi minima recusandae
                doloribus, magni optio in iusto quae quod ad ipsa eligendi impedit! Quia magnam iusto dolor facere.</p>
            <div style=\"display: block; margin-bottom: 40px\">
                <div>
                    <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
                        <tbody>
                        <tr>
                            <td>Nom & Prenom</td>
                            <td align=\"left\" bgcolor='#2B2A2A'>";
        // line 98
        echo twig_escape_filter($this->env, ($context["lastname"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["firstname"] ?? null), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Numéro télephone</td>
                            <td align=\"left\" bgcolor='#2B2A2A'>";
        // line 102
        echo twig_escape_filter($this->env, ($context["phone"] ?? null), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Adresse email</td>
                            <td align=\"left\" bgcolor='#2B2A2A'>";
        // line 106
        echo twig_escape_filter($this->env, ($context["email"] ?? null), "html", null, true);
        echo "</td>
                        </tr>
                        </tbody>
                    </table>
                    <p style=\"margin-bottom: 20px\"></p>
                    <h2>Information de véhicules à envoyer</h2>
                    <table width=\"100%\" border=\"1\">
                        <tbody>
                        <tr>
                            <td>Marque</td>
                            <td align=\"center\" bgcolor='#2B2A2A'>";
        // line 116
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["info"] ?? null), "mark", [], "any", false, false, false, 116), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td align=\"center\" bgcolor='#2B2A2A'>";
        // line 120
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["info"] ?? null), "model", [], "any", false, false, false, 120), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>N° de châssis</td>
                            <td align=\"center\" bgcolor='#2B2A2A'>";
        // line 124
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["info"] ?? null), "chassi", [], "any", false, false, false, 124), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Année de fabrication</td>
                            <td align=\"center\" bgcolor='#2B2A2A'>";
        // line 128
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["info"] ?? null), "year", [], "any", false, false, false, 128), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Dimension</td>
                            <td align=\"center\" bgcolor='#2B2A2A'>";
        // line 132
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["info"] ?? null), "size", [], "any", false, false, false, 132), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Poids</td>
                            <td align=\"center\" bgcolor='#2B2A2A'>";
        // line 136
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["info"] ?? null), "weight", [], "any", false, false, false, 136), "html", null, true);
        echo "</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <h2>Coordonnées de destinataire</h2>
                    <table width=\"95%\" border=\"1\">
                        <tbody>
                        <tr>
                            <td>Nom & Prénom du destinaraire</td>
                            <td align=\"left\" bgcolor='#2B2A2A'>";
        // line 148
        echo twig_escape_filter($this->env, ($context["recipient_firstname"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["recipient_lastname"] ?? null), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Adresse email du destinataire</td>
                            <td align=\"left\" bgcolor='#2B2A2A'>";
        // line 152
        echo twig_escape_filter($this->env, ($context["recipient_email"] ?? null), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Numéro télephone du destinatair</td>
                            <td align=\"left\" bgcolor='#2B2A2A'>";
        // line 156
        echo twig_escape_filter($this->env, ($context["recipient_telephone"] ?? null), "html", null, true);
        echo "</td>
                        </tr>
                        </tbody>
                    </table>

                    <p style=\"margin-bottom: 20px\"></p>
                    <h2>Les documents à fournir</h2>
                    <table width=\"95%\" border=\"1\">
                        <tbody>
                        ";
        // line 165
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["files"] ?? null));
        foreach ($context['_seq'] as $context["slug"] => $context["file"]) {
            // line 166
            echo "                        <tr>
                            <td>";
            // line 167
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["file"], "name", [], "any", false, false, false, 167), "html", null, true);
            echo " <i>(";
            echo twig_escape_filter($this->env, $context["slug"], "html", null, true);
            echo ")</i></td>
                            <td align=\"center\" style=\"padding:15px\">
                                <a href=\"";
            // line 169
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["file"], "url", [], "any", false, false, false, 169), "html", null, true);
            echo "\" target=\"_blank\"
                                   style=\"margin-top: 10px; padding: 10px 15px 10px 15px; background-color: red; text-decoration: none; color: aliceblue\">TELECHARGER</a>
                            </td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['slug'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "                        </tbody>
                    </table>
                </div>
            </div>


            <div style=\"display: block\">
                <div >
                    <table width=\"100%\" border=\"1\">
                        <tbody>
                        <tr>
                            <th scope=\"col\" width=\"60%\" bgcolor='#2B2A2A'>Designation</th>
                            <th scope=\"col\" width=\"50\" bgcolor='#2B2A2A'>Qte</th>
                            <th scope=\"col\" bgcolor='#2B2A2A'>Prix HT</th>
                        </tr>
                        <tr>
                            <td>";
        // line 190
        echo twig_escape_filter($this->env, ($context["category_car"] ?? null), "html", null, true);
        echo " + ";
        echo twig_escape_filter($this->env, ($context["country"] ?? null), "html", null, true);
        echo "</td>
                            <td align=\"center\">";
        // line 191
        echo twig_escape_filter($this->env, ($context["qty"] ?? null), "html", null, true);
        echo "</td>
                            <td align=\"center\">";
        // line 192
        echo twig_escape_filter($this->env, ($context["cost"] ?? null), "html", null, true);
        echo " €</td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" align=\"right\" style=\"padding-right: 10px\">TOTAL TTC</td>
                            <td align=\"center\" bgcolor=\"#ffda10\"
                                style=\"font-size: 30px; color: black; font-weight: 900\">
                                ";
        // line 198
        echo twig_escape_filter($this->env, ($context["cost"] ?? null), "html", null, true);
        echo " €
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <p>
                * Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis voluptatum ullam sunt
            </p>
        </div>
    </div>

    <p style=\"font-size:12px;text-align:center\">XXXX XX Xxxxxx, Antananarivo 101 | Téléphone: XXX XX XX XXX XX <br>
        Copyright© <span class=\"il\">Euromada</span>. Tous les droits sont réservés.</p>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "reservation.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  308 => 198,  299 => 192,  295 => 191,  289 => 190,  271 => 174,  260 => 169,  253 => 167,  250 => 166,  246 => 165,  234 => 156,  227 => 152,  218 => 148,  203 => 136,  196 => 132,  189 => 128,  182 => 124,  175 => 120,  168 => 116,  155 => 106,  148 => 102,  139 => 98,  120 => 82,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "reservation.html", "/home/c1227488c/public_html/euromada/wp-content/themes/blo/includes/templates/reservation.html");
    }
}
