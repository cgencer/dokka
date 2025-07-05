<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/custom/gavias_unix/templates/page/parts/topbar.html.twig */
class __TwigTemplate_705045e0c0562d56d1890ba8ceffef66b8496ef9322e0d09864d40c38505a220 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 8];
        $filters = ["escape" => 9, "t" => 48, "raw" => 53];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 't', 'raw'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

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

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"topbar\">
  <div class=\"container\">
    <div class=\"topbar-inner\">
      <div class=\"row\">
        
        <div class=\"topbar-left col-sm-6 col-xs-6\">
          <div class=\"social-list\">
            ";
        // line 8
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "facebook", [])) {
            // line 9
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "facebook", [])), "html", null, true);
            echo "\"><i class=\"fa fa-facebook\"></i></a>
            ";
        }
        // line 10
        echo " 
            ";
        // line 11
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "twitter", [])) {
            // line 12
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "twitter", [])), "html", null, true);
            echo "\"><i class=\"fa fa-twitter-square\"></i></a>
            ";
        }
        // line 13
        echo " 
            ";
        // line 14
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "skype", [])) {
            // line 15
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "skype", [])), "html", null, true);
            echo "\"><i class=\"fa fa-skype\"></i></a>
            ";
        }
        // line 16
        echo " 
            ";
        // line 17
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "instagram", [])) {
            // line 18
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "instagram", [])), "html", null, true);
            echo "\"><i class=\"fa fa-instagram\"></i></a>
            ";
        }
        // line 19
        echo " 
            ";
        // line 20
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "dribbble", [])) {
            // line 21
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "dribbble", [])), "html", null, true);
            echo "\"><i class=\"fa fa-dribbble\"></i></a>
            ";
        }
        // line 22
        echo " 
            ";
        // line 23
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "linkedin", [])) {
            // line 24
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "linkedin", [])), "html", null, true);
            echo "\"><i class=\"fa fa-linkedin-square\"></i></a>
            ";
        }
        // line 25
        echo " 
            ";
        // line 26
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "pinterest", [])) {
            // line 27
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "pinterest", [])), "html", null, true);
            echo "\"><i class=\"fa fa-pinterest\"></i></a>
            ";
        }
        // line 28
        echo " 
            ";
        // line 29
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "google", [])) {
            // line 30
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "google", [])), "html", null, true);
            echo "\"><i class=\"fa fa-google-plus-square\"></i></a>
            ";
        }
        // line 31
        echo " 
            ";
        // line 32
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "youtube", [])) {
            // line 33
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "youtube", [])), "html", null, true);
            echo "\"><i class=\"fa fa-youtube-square\"></i></a>
            ";
        }
        // line 34
        echo " 
            ";
        // line 35
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "vimeo", [])) {
            // line 36
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "vimeo", [])), "html", null, true);
            echo "\"><i class=\"fa fa-vimeo-square\"></i></a>
            ";
        }
        // line 37
        echo "  
            ";
        // line 38
        if ($this->getAttribute(($context["custom_social_link"] ?? null), "tumblr", [])) {
            // line 39
            echo "              <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["custom_social_link"] ?? null), "tumblr", [])), "html", null, true);
            echo "\"><i class=\"fa fa-tumblr-square\"></i></a>
            ";
        }
        // line 40
        echo "  
          </div>
        </div>

        <div class=\"topbar-right col-sm-6 col-xs-6\">
          
          ";
        // line 46
        if ((($context["custom_account"] ?? null) == "")) {
            // line 47
            echo "            <ul class=\"gva_topbar_menu\">
              <li><a href=\"";
            // line 48
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["login_link"] ?? null)), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Login"));
            echo "</a></li>
              <li><a href=\"";
            // line 49
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["register_link"] ?? null)), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Register"));
            echo "</a></li>
            </ul>  
          ";
        } else {
            // line 52
            echo "            <ul class=\"gva_topbar_menu login\">
              <li>";
            // line 53
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed(($context["custom_account"] ?? null)));
            echo "</li>
            </ul>  
          ";
        }
        // line 55
        echo "  
        </div>

      </div>
    </div>  
  </div>  
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/custom/gavias_unix/templates/page/parts/topbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  218 => 55,  212 => 53,  209 => 52,  201 => 49,  195 => 48,  192 => 47,  190 => 46,  182 => 40,  176 => 39,  174 => 38,  171 => 37,  165 => 36,  163 => 35,  160 => 34,  154 => 33,  152 => 32,  149 => 31,  143 => 30,  141 => 29,  138 => 28,  132 => 27,  130 => 26,  127 => 25,  121 => 24,  119 => 23,  116 => 22,  110 => 21,  108 => 20,  105 => 19,  99 => 18,  97 => 17,  94 => 16,  88 => 15,  86 => 14,  83 => 13,  77 => 12,  75 => 11,  72 => 10,  66 => 9,  64 => 8,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/custom/gavias_unix/templates/page/parts/topbar.html.twig", "/opt/drupal/web/themes/custom/custom/gavias_unix/templates/page/parts/topbar.html.twig");
    }
}
