<template>
  <div class="editor">
    <editor-content class="editor__content dasd" :editor="editor" />
  </div>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import {bus} from '../app';

import {
  Blockquote,
  CodeBlock,
  HardBreak,
  Heading,
  HorizontalRule,
  OrderedList,
  BulletList,
  ListItem,
  TodoItem,
  TodoList,
  Bold,
  Code,
  Italic,
  Link,
  Strike,
  Underline,
  History,
} from 'tiptap-extensions'

export default {
  components: {
    EditorContent,
    EditorMenuBar,
  },
  data() {
    return {
      editor: new Editor({
        extensions: [
          new Blockquote(),
          new BulletList(),
          new CodeBlock(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3, 4] }),
          new HorizontalRule(),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Link(),
          new Bold(),
          new Code(),
          new Italic(),
          new Strike(),
          new Underline(),
          new History(),
        ],
        content: '',
        onUpdate: _.debounce(function({ state, getHTML, getJSON, transaction }) {
          var title, titleRaw, caption, captionRaw = '';
          var json = getJSON();
          if (json.content.length) {
            title = json.content.shift();
            titleRaw = title.content[0].text;
            
            if (json.content.length) {
              caption = json.content.shift();
              for(var i = 0; i < caption.content.length; i++) {
                captionRaw += caption.content[i].text;
              }
            }
          }
          bus.$http.post('/api/notes/update', {
              page_id: pageid,
              title: titleRaw,
              caption: captionRaw,
              content: getHTML(),
              _token: window.Laravel['csrfToken']
          })
			.then(function(response) {
				bus.$emit('noteInformation', response.data[0]);
			});
          bus.$emit('filterSidebar', '');
        }, 300),

      }),
    }
  },
  beforeDestroy() {
    this.editor.destroy()
  },
  methods: {
    fetch: function(pageid) {
       var self = this;
        this.$http.get('/api/note/' + pageid)
        .then(function(response) {
            bus.$emit('noteInformation', response.data[0]);
            self.editor.setContent(response.data[0].note_content);
        });
    }
  },
  created() {
      var self = this;
      self.fetch(pageid);

      bus.$on('updateComponents', (newid) => {
          self.fetch(newid);
      });
  }


}
</script>
