<?php

require_once("../DependencyContainer.php");

$container = new DependencyContainer();

$global_scope_checker = true;

$container->inject("test", function($arguments)
{
    return  [
        "depends" =>
          $arguments["sammy"] . $arguments[0] . $arguments[1]()  
        ];
    },
    [   "sammy" => "zane",
        3,
        function() { return 42; }
    ]
);

$container->inject("test2", function($args)
{
    global $global_scope_checker;
    $global_scope_checker = false;
    return true;
});


echo "Beginning test for DependencyContainer\n\n";

assert(!$container->has("test"));
echo ".";

$dep = $container->get("test");
assert(is_array($dep));
echo ".";

assert(count($dep) == 1);
echo ".";

assert("zane342" == $dep["depends"]);
echo ".";

/**
 * This test ensures that dependencies aren't initialized until they're called,
 * to ensure that we can setup a bunch of dependencies up front, but not necessarily
 * need to load them all into memory if our request doesn't call for it.
 */

assert($global_scope_checker);
echo ".";

$dep = $container->get("test2");
assert(!$global_scope_checker);
echo ".";

assert($dep);
echo ".";

/**
 * This test ensures that the proper NotFoundExceptions are thrown
 */
// TODO

/**
 * This test ensures that exceptions are thrown properly when our injectors throw
 * errors.
 */
// TODO

echo "\n\nTest suite complete! All tests pass.\n";