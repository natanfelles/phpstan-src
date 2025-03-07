<?php declare(strict_types = 1);

namespace PHPStan\Analyser;

use PHPStan\Testing\TypeInferenceTestCase;

class NodeScopeResolverTest extends TypeInferenceTestCase
{

	public function dataFileAsserts(): iterable
	{
		require_once __DIR__ . '/data/bug2574.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug2574.php');

		require_once __DIR__ . '/data/bug2577.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug2577.php');

		require_once __DIR__ . '/data/generics.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/generics.php');

		require_once __DIR__ . '/data/generic-class-string.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/generic-class-string.php');

		require_once __DIR__ . '/data/instanceof.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/instanceof.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/integer-range-types.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/random-int.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/closure-return-type-extensions.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-key.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/intersection-static.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/static-properties.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/static-methods.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2612.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2677.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2676.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/psalm-prefix-unresolvable.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/complex-generics-example.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2648.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2740.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2822.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/inheritdoc-parameter-remapping.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/inheritdoc-constructors.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/list-type.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2835.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2443.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2750.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2850.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2863.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/native-types.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/type-change-after-array-access-assignment.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/iterator_to_array.php');

		if (self::$useStaticReflectionProvider || extension_loaded('ds')) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/ext-ds.php');
		}
		if (self::$useStaticReflectionProvider || PHP_VERSION_ID >= 70401) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/arrow-function-return-type.php');
		}
		yield from $this->gatherAssertTypes(__DIR__ . '/data/is-numeric.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/is-a.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3142.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-shapes-keys-strings.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1216.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/const-expr-phpdoc-type.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3226.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2001.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2232.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3009.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/inherit-phpdoc-merging-var.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/inherit-phpdoc-merging-param.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/inherit-phpdoc-merging-return.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/inherit-phpdoc-merging-template.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3266.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3269.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/assign-nested-arrays.php');
		if (self::$useStaticReflectionProvider || PHP_VERSION_ID >= 70400) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3276.php');
		}
		yield from $this->gatherAssertTypes(__DIR__ . '/data/shadowed-trait-methods.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/const-in-functions.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/const-in-functions-namespaced.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/root-scope-maybe-defined.php');
		if (PHP_VERSION_ID < 80000) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3336.php');
		}
		if (self::$useStaticReflectionProvider || PHP_VERSION_ID >= 80000) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/catch-without-variable.php');
		}
		yield from $this->gatherAssertTypes(__DIR__ . '/data/mixed-typehint.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2600.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-typehint-without-null-in-phpdoc.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/override-root-scope-variable.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bitwise-not.php');
		if (extension_loaded('gd')) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/graphics-draw-return-types.php');
		}

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			require_once __DIR__ . '/../../../stubs/runtime/ReflectionUnionType.php';

			yield from $this->gatherAssertTypes(__DIR__ . '/../Reflection/data/unionTypes.php');
		}

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/../Reflection/data/mixedType.php');
		}

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/../Reflection/data/staticReturnType.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/minmax-arrays.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/classPhpDocs.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/non-empty-array-key-type.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3133.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Comparison/data/bug-2550.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2899.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/preg_split.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bcmath-dynamic-return.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3875.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2611.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3548.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3866.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1014.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-pr-339.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/pow.php');
		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-expr.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/non-empty-array.php');

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/class-constant-on-expr.php');
		}

		if (PHP_VERSION_ID >= 80000) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3961-php8.php');
		} else {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3961.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1924.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/extra-int-types.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/count-type.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2816.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2816-2.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3985.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-slice.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3990.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3991.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3993.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3997.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4016.php');

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/promoted-properties-types.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/early-termination-phpdoc.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3915.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2378.php');

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/match-expr.php');
		}

		if (PHP_VERSION_ID >= 80000 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/nullsafe.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/specified-types-closure-use.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/cast-to-numeric-string.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2539.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2733.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3132.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1233.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/comparison-operators.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3880.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/inc-dec-in-conditions.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4099.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3760.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2997.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1657.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2945.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4207.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4206.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-empty-array.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4205.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/dependent-variable-certainty.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1865.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/conditional-non-empty-array.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/foreach-dependent-key-value.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/dependent-variables-type-guard-same-as-type.php');

		if (PHP_VERSION_ID >= 70400 || self::$useStaticReflectionProvider) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/dependent-variables-arrow-function.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-801.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1209.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2980.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3986.php');

		if (PHP_VERSION_ID >= 70400) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4188.php');
		}

		if (PHP_VERSION_ID >= 70400) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4339.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4343.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/impure-method.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4351.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/var-above-use.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/var-above-declare.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/closure-return-type.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4398.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4415.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/compact.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4500.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4504.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4436.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Properties/data/bug-3777.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2549.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1945.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2003.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-651.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1283.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4538.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/proc_get_status.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Methods/data/bug-4552.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1897.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1801.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2927.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4558.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4557.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4209.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4209-2.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2869.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3024.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3134.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Methods/data/infer-array-key.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/offset-value-after-assign.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2112.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-map-closure.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-sum.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4573.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4577.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4579.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3321.php');

		require_once __DIR__ . '/../Rules/Generics/data/bug-3769.php';
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Generics/data/bug-3769.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/instanceof-class-string.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4498.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4587.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4606.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/nested-generic-types.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3922.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/nested-generic-types-unwrapping.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/nested-generic-types-unwrapping-covariant.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/nested-generic-incomplete-constructor.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/iterator-iterator.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4642.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/PhpDoc/data/bug-4643.php');
		require_once __DIR__ . '/data/throw-points/helpers.php';
		if (PHP_VERSION_ID >= 80000) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/php8/null-safe-method-call.php');
		}
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/and.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/array.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/array-dim-fetch.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/assign.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/assign-op.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/do-while.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/for.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/foreach.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/func-call.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/if.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/method-call.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/or.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/property-fetch.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/static-call.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/switch.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/throw.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/try-catch-finally.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/variable.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/while.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/throw-points/try-catch.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/phpdoc-pseudotype-override.php');
		require_once __DIR__ . '/data/phpdoc-pseudotype-namespace.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/phpdoc-pseudotype-namespace.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/phpdoc-pseudotype-global.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generic-traits.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4423.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generic-unions.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generic-parent.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4247.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4267.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2231.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3558.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3351.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4213.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4657.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4707.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4545.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4714.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4725.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4733.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4326.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-987.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3677.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4215.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4695.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2977.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3190.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/ternary-specified-types.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-560.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/do-not-remember-impure-functions.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4190.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/clear-stat-cache.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/invalidate-object-argument.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/invalidate-object-argument-static.php');

		require_once __DIR__ . '/data/invalidate-object-argument-function.php';
		yield from $this->gatherAssertTypes(__DIR__ . '/data/invalidate-object-argument-function.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4588.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4091.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3382.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4177.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2288.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1157.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1597.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3617.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-778.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2969.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3004.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3710.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3822.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-505.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1670.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1219.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3302.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-1511.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4434.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4231.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4287.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4700.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/phpdoc-in-closure-bind.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/multi-assign.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generics-reduce-types-first.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4803.php');

		require_once __DIR__ . '/data/type-aliases.php';

		yield from $this->gatherAssertTypes(__DIR__ . '/data/type-aliases.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4650.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2906.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/DateTimeDynamicReturnTypes.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4821.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4838.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4879.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4820.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4822.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4816.php');

		if (self::$useStaticReflectionProvider || PHP_VERSION_ID >= 80000) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4757.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4814.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4982.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4761.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3331.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3106.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2640.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-2413.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3446.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/getopt.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generics-default.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4985.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-5000.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/number_format.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-5140.php');

		if (self::$useStaticReflectionProvider || PHP_VERSION_ID >= 80000) {
			yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Comparison/data/bug-4857.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/empty-array-shape.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Methods/data/bug-5089.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3158.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Methods/data/unable-to-resolve-callback-parameter-type.php');

		require_once __DIR__ . '/../Rules/Functions/data/varying-acceptor.php';
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Functions/data/varying-acceptor.php');

		yield from $this->gatherAssertTypes(__DIR__ . '/data/uksort-bug.php');

		if (self::$useStaticReflectionProvider || PHP_VERSION_ID >= 70400) {
			yield from $this->gatherAssertTypes(__DIR__ . '/data/arrow-function-types.php');
			yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4902.php');
		}

		yield from $this->gatherAssertTypes(__DIR__ . '/data/closure-types.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-5219.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/strval.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/array-next.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/non-empty-string.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-3981.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/bug-4711.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/sscanf.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generic-offset-get.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/generic-object-lower-bound.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/data/class-reflection-interfaces.php');
		yield from $this->gatherAssertTypes(__DIR__ . '/../Rules/Methods/data/bug-4415.php');
	}

	/**
	 * @dataProvider dataFileAsserts
	 * @param string $assertType
	 * @param string $file
	 * @param mixed ...$args
	 */
	public function testFileAsserts(
		string $assertType,
		string $file,
		...$args
	): void
	{
		$this->assertFileAsserts($assertType, $file, ...$args);
	}

	public static function getAdditionalConfigFiles(): array
	{
		return [
			__DIR__ . '/../../../conf/bleedingEdge.neon',
			__DIR__ . '/typeAliases.neon',
		];
	}

}
