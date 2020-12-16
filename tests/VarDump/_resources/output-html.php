<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevere.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return '<html style="background: #132537;"><head></head><body>%handlerClassName%->%handlerFunctionName%()<hr><pre style="font: 14px \'Fira Code Retina\', \'Operator Mono\', Inconsolata, Consolas,
    monospace, sans-serif; line-height: 1.2; color: #ecf0f1; padding: 15px; margin: 10px 0; word-break: break-word; white-space: pre-wrap; background: #132537; display: block; text-align: left; border: none; border-radius: 4px;">
<span style="color:#3498db">%className%</span>-><span style="color:#9b59b6">%functionName%()</span>
<span style="color:inherit">%fileLine%</span>

Arg#1 <span style="color:#7f8c8d">null</span></pre></body></html>';
