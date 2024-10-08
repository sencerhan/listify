    
    
    Route::get('/message/checkNew', [MessageController::class, 'checkNew'])->name("message.checkNew");
    Route::post('/message/checkNew', [MessageController::class, 'checkNew'])->name("message.checkNew");
    Route::post('/message/send', [MessageController::class, 'send'])->name("message.send");
    Route::get('/message/getMessagesByUserId', [MessageController::class, 'getMessagesByUserId'])->name("message.getMessagesByUserId");
    Route::post('/message/getMessagesByUserId', [MessageController::class, 'getMessagesByUserId'])->name("message.getMessagesByUserId");
    Route::post('/message/delete', [MessageController::class, 'delete'])->name("message.delete");