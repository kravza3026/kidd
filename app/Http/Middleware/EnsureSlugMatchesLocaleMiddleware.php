<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class EnsureSlugMatchesLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentLocale = LaravelLocalization::getCurrentLocale();
        $route = $request->route();

        if (! $route) {
            return $next($request);
        }

        $parameters = $route->parameters();

        foreach ($parameters as $key => $value) {

            // Get the parameter name and try to find the model class
            $modelClass = $this->getModelClassFromRoute($route, $key);

            if (! $modelClass || ! class_exists($modelClass)) {
                continue;
            }

            // Check if model has translatable slugs
            if (! method_exists($modelClass, 'getSlugOptions')) {
                continue;
            }

            // Find the model by checking all locale slugs
            $model = $value;
            //            $model = $this->findModelBySlug($modelClass, $value);

            if (! $model) {
                continue;
            }

            // Get the slug for the current locale
            $slugField = $model->getSlugOptions()->slugField;
            $localizedSlug = $model->getTranslation($slugField, $currentLocale, false);

            // Replace the route parameter with the localized slug
            if ($localizedSlug && $localizedSlug !== $route->originalParameters()[$key]) {
                $route->setParameter($key, $localizedSlug);

                return redirect(route($route->getName(), $route->parameters()));

            }

        }

        return $next($request);
    }

    /**
     * Get the model class from route binding.
     */
    protected function getModelClassFromRoute($route, string $parameterName): ?string
    {
        $bindingFields = $route->bindingFields();

        if (isset($bindingFields[$parameterName])) {
            return $bindingFields[$parameterName];
        }

        // Try to get from route action
        $action = $route->getAction();

        if (isset($action['bindings'][$parameterName])) {
            return $action['bindings'][$parameterName];
        }

        // Fallback: try to guess from parameter name
        $modelName = 'App\\Models\\'.ucfirst($parameterName);

        return class_exists($modelName) ? $modelName : null;
    }

    /**
     * Find a model by checking all possible locale slugs.
     */
    protected function findModelBySlug(string $modelClass, string $slug)
    {
        $tempModel = new $modelClass;

        if (! method_exists($tempModel, 'getSlugOptions')) {
            return null;
        }

        $slugField = $tempModel->getSlugOptions()->slugField;

        $query = $modelClass::query();

        // Build query to check slug in all locales
        $query->where(function ($q) use ($slugField, $slug) {
            foreach (array_keys(config('app.locales')) as $locale) {
                $q->orWhere("{$slugField}->{$locale}", $slug);
            }
        });

        return $query->first();
    }
}
