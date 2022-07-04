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

/* modules/contrib/eck/templates/eck-content-add-list.html.twig */
class __TwigTemplate_14d0173607f4668ed5a84454a8533bdc8c84f1c9983f4ffd769f7ef77ee61024 extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        if ( !twig_test_empty(($context["types"] ?? null))) {
            // line 22
            echo "    <ul class=\"admin-list\">
        ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["types"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                // line 24
                echo "            <li class=\"clearfix\">
                <a href=\"";
                // line 25
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["type"], "add_link", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
                echo "\">
            <span class=\"label\">
              ";
                // line 27
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["type"], "type", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
                echo "
            </span>

                    <div class=\"description\">
                        ";
                // line 31
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["type"], "description", [], "any", false, false, true, 31), 31, $this->source), "html", null, true);
                echo "
                    </div>
                </a>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "    </ul>
";
        } else {
            // line 38
            echo "    <p>
        ";
            // line 39
            $context["create_bundle"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath((("eck.entity." . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["entity_type"] ?? null), "id", [], "any", false, false, true, 39), 39, $this->source)) . "_type.add"));
            // line 40
            echo "        ";
            echo t("You have not created any bundles for this type yet. Go to the <a
                href=\"@create_bundle\"> bundle creation page</a> to add a
        new bundle.", array("@create_bundle" =>             // line 42
($context["create_bundle"] ?? null), ));
            // line 45
            echo "    </p>
";
        }
    }

    public function getTemplateName()
    {
        return "modules/contrib/eck/templates/eck-content-add-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 45,  87 => 42,  83 => 40,  81 => 39,  78 => 38,  74 => 36,  63 => 31,  56 => 27,  51 => 25,  48 => 24,  44 => 23,  41 => 22,  39 => 21,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/eck/templates/eck-content-add-list.html.twig", "C:\\xampp\\htdocs\\vendorportal\\web\\modules\\contrib\\eck\\templates\\eck-content-add-list.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 21, "for" => 23, "set" => 39, "trans" => 40);
        static $filters = array("escape" => 25);
        static $functions = array("path" => 39);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set', 'trans'],
                ['escape'],
                ['path']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
