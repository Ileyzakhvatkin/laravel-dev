<?php

namespace MyHelpers;

class helpm6
{
    public function store(TagsSynchronizer $tSync, ArticleFormRequest $request)
    {
        $this->nextByRoleAjax(['admin', 'author']);
        try {
            $article = Article::create(array_merge($request->allCorrectFields(),
                ['owner_id' => Auth::user()->id, 'created_at' => now(), 'updated_at' => now()]));
            $tSync->sync(collect(explode(',', request('tags'))), $article);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return $this->ajaxError('Не удалось добавить новую статью!');
        }
        return $this->ajaxSuccess('Статья успешно добавлена!');
    }
}
