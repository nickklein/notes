<template>
  <div class="editor">
    
    <!-- <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div class="menubar">

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.bold() }"
          @click="commands.bold"
        >
        Bold
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.italic() }"
          @click="commands.italic"
        >
        Italic
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.strike() }"
          @click="commands.strike"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.underline() }"
          @click="commands.underline"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.code() }"
          @click="commands.code"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.paragraph() }"
          @click="commands.paragraph"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 1 }) }"
          @click="commands.heading({ level: 1 })"
        >
          H1
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 2 }) }"
          @click="commands.heading({ level: 2 })"
        >
          H2
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 3 }) }"
          @click="commands.heading({ level: 3 })"
        >
          H3
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.bullet_list() }"
          @click="commands.bullet_list"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.ordered_list() }"
          @click="commands.ordered_list"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.blockquote() }"
          @click="commands.blockquote"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.code_block() }"
          @click="commands.code_block"
        >
        </button>

        <button
          class="menubar__button"
          @click="commands.horizontal_rule"
        >
        </button>

        <button
          class="menubar__button"
          @click="commands.undo"
        >
        </button>

        <button
          class="menubar__button"
          @click="commands.redo"
        >
        </button>

      </div>
    </editor-menu-bar> -->

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
          new Heading({ levels: [1, 2, 3] }),
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
              type: 'content',
              page_id: pageid,
              title: titleRaw,
              caption: captionRaw,
              content: getHTML(),
              _token: window.Laravel['csrfToken']
          });
          bus.$emit('filterSidebar', '');
        }, 1000),

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
            var activePin = false;
            if (response.data[0].nsetting_id !== null && response.data[0].nsetting_id == '2') {
                activePin = true;
            }
            bus.$emit('activePin', activePin);
            self.editor.setContent(response.data[0].note_content);
        });
    }
  },
  created() {
      this.fetch(pageid);

      bus.$on('updateComponents', (newid) => {
          this.fetch(newid);
      });
  }


}
</script>
