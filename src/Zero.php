<?php

namespace Mzr\Zero;

class Zero
{
    public function greet()
    {
        return 'Hi! Zero is Installed. --'.config('zero.zadid');
    }
}
